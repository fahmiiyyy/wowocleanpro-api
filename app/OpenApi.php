<?php

namespace App;

use OpenApi\Attributes as OA;

#[OA\Info(
    version: "1.0.0",
    title: "WowoClean Pro API",
    description: "API Dokumentasi WowoClean"
)]
#[OA\PathItem(path: "/")]
class OpenApi
{
}