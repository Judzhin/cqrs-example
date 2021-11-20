<?php declare(strict_types=1);
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace App\BlogEngine\DomainModel;

/**
 * Class PostView
 *
 * @package App\BlogEngine\DomainModel
 */
class PostView
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $content;

    /**
     * @var array
     */
    private array $comments;

    public function __construct($id, $title, $content, array $comments = [])
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->comments = $comments;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return array
     */
    public function getComments()
    {
        return $this->comments;
    }
}