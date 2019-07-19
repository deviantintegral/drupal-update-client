<?php

namespace Deviantintegral\DrupalUpdateClient;

use Deviantintegral\DrupalUpdateClient\Exception\InvalidXmlException;
use GuzzleHttp\Exception\BadResponseException;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Guzzle middleware functions.
 */
class Middleware
{
    /**
     * A middleware to check for errors in the body of the response.
     *
     * @return \Closure A middleware function.
     */
    public static function errors(): \Closure
    {
        // Guzzle's built-in middlewares also have this level of nested
        // functions, so we follow the same pattern even though it's difficult
        // to read.
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                // We only need to process after the request has been sent.
                return $handler($request, $options)->then(
                    function (ResponseInterface $response) use ($request, $handler) {
                        // While it's not documented, we want to be sure that
                        // any 4XX or 5XX errors that break through suppression
                        // are still parsed. In other words, this handler should
                        // be executed before the normal Guzzle error handler.

                        // If our response isn't XML, we can't parse it.
                        $contentType = $response->getHeaderLine('Content-Type');
                        if (0 === preg_match('!^(application|text)\/xml!', $contentType)) {
                            return $response;
                        }

                        $serializer = Serializer::create();
                        try {
                            if ($error = $serializer->deserializeError($response->getBody())) {
                                throw new BadResponseException($error->getMessage(), $request);
                            }
                        } catch (InvalidXmlException $e) {
                            // Fall through as we know this is not an error.
                        }

                        return $response;
                    }
                );
            };
        };
    }
}
