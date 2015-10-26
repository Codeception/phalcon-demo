<?php

namespace PhalconDemo\Plugins\Acl\Resource;

interface ResourceInterface
{
    /**
     * Returns private resources
     *
     * @return array
     */
    public function getPrivateResources();

    /**
     * Returns public resources
     *
     * @return array
     */
    public function getPublicResources();

    /**
     * Returns public resources
     *
     * @return array
     */
    public function getAllResources();

    /**
     * Resource is exists?
     *
     * @param string $name
     * @return bool
     */
    public function hasResource($name);

    /**
     * Resource has access?
     *
     * @param string $resource
     * @param string $access
     * @return bool
     */
    public function hasAccess($resource, $access);
}
