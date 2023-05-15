<?php

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Weather RestAPI",
 *      description="This is my API for simple weather using REST with laravel and mysql",
 *      @OA\Contact(
 *          email="black.delfino28@gmail.com"
 *      ),
 *      @OA\License(
 *          name="Apache 2.0",
 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * )
 */

/**
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="API Server"
 * )

 * @OA\Tag(
 *     name="Weather",
 *     description="API Endpoints for weather conditions"
 * )
 */

/**
 * @OA\SecurityScheme(
 *      securityScheme="bearerAuth",
 *      type="http",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
 */
