<?php

namespace Spatie\ResponseCache\Hasher;

use Illuminate\Http\Request;
use Spatie\ResponseCache\CacheProfiles\CacheProfile;

class DefaultHasher implements RequestHasher
{
	/**
	 * @var CacheProfile
	 */
    protected $cacheProfile;

	/**
	 * DefaultHasher constructor.
	 *
	 * @param CacheProfile $cacheProfile
	 */
    public function __construct(CacheProfile $cacheProfile)
    {
        $this->cacheProfile = $cacheProfile;
    }

	/**
	 * @param Request $request
	 * @return string
	 */
    public function getHashFor(Request $request): string
    {
        return 'responsecache-'.md5(
            "{$request->getHost()}-{$request->getRequestUri()}-{$request->getMethod()}/".$this->cacheProfile->useCacheNameSuffix($request)
        );
    }
}
