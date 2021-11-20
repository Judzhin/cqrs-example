<?php declare(strict_types=1);
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace App\BlogEngine\DomainModel;

/**
 * Interface PostViewRepository
 *
 * @package App\BlogEngine\DomainModel
 */
interface PostViewRepository
{
    /**
     * Get a post view by its id
     *
     * @param string $id
     *
     * @return PostView
     */
    public function get($id);

    /**
     * Get all of the post views
     *
     * @return PostView[]
     */
    public function all();
}