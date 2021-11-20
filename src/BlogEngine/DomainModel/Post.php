<?php

namespace App\BlogEngine\DomainModel;

use Buttercup\Protects\DomainEvent;
use Buttercup\Protects\DomainEvents;
use Buttercup\Protects\IsEventSourced;
use Buttercup\Protects\RecordsEvents;
use Verraes\ClassFunctions\ClassFunctions;

/**
 * Class Post
 * @package App\BlogEngine\DomainModel
 */
class Post implements RecordsEvents, IsEventSourced
{
    const STATE_DRAFT = 10;
    const STATE_PUBLISHED = 20;

    /**
     * @var DomainEvent[]
     */
    private $recordedEvents = [];

    /**
     * Post constructor.
     * @param PostId $postId
     * @param string $title
     * @param string $content
     * @param int $state
     * @param array $comments
     */
    private function __construct(
        PostId $postId,
        string $title,
        string $content,
        int $state = self::STATE_DRAFT,
        array $comments = [])
    {
    }

    /**
     * @param $aPostId
     * @return Post
     */
    private static function createEmptyPostWith($aPostId)
    {
        return new Post($aPostId, '', '', static::STATE_DRAFT);
    }

    /**
     * Get all the Domain Events that were recorded since the last time it was cleared, or since it was
     * restored from persistence. This does not include events that were recorded prior.
     *
     * @return DomainEvents
     */
    public function getRecordedEvents(): DomainEvents
    {
        return new DomainEvents($this->recordedEvents);
        // return $this->recordedEvents;
    }

    /**
     * Clears the record of new Domain Events. This doesn't clear the history of the object.
     * @return void
     */
    public function clearRecordedEvents()
    {
        $this->recordedEvents = [];
    }

    /**
     * @param PostId $aPostId
     * @param string $aTitle
     * @param string $aContent
     * @return static
     */
    public static function create(PostId $aPostId, string $aTitle, string $aContent): self
    {
        $aNewPost = new Post($aPostId, $aTitle, $aContent, static::STATE_DRAFT);
        $aNewPost->recordThat(
            new PostWasCreated($aPostId, $aTitle, $aContent, static::STATE_DRAFT)
        );
        return $aNewPost;
    }

//    public function publish()
//    {
//        $this->applyAndRecordThat(
//            new PostWasPublished($this->postId)
//        );
//    }
//
//    public function changeTitle($aNewTitle)
//    {
//        $this->applyAndRecordThat(
//            new PostTitleWasChanged($this->postId, $aNewTitle)
//        );
//    }
//
//    public function changeContent($aNewContent)
//    {
//        $this->applyAndRecordThat(
//            new PostContentWasChanged($this->postId, $aNewContent)
//        );
//    }

    /**
     * @param $aNewComment
     */
    public function comment($aNewComment)
    {
        $this->applyAndRecordThat(
            new CommentWasAdded($this->postId, CommentId::generate(), $aNewComment)
        );
    }

    /**
     * @param DomainEvent $aDomainEvent
     */
    private function recordThat(DomainEvent $aDomainEvent)
    {
        $this->recordedEvents[] = $aDomainEvent;
    }

    private function applyAndRecordThat(DomainEvent $aDomainEvent)
    {
        $this->recordThat($aDomainEvent);
        $this->apply($aDomainEvent);
    }

    /**
     * Allow to reconstitute an aggregate from an aggregate events history and an initial state
     *
     * @param AggregateHistory $anAggregateHistory
     *
     * @return RecordsEvents
     */
    public static function reconstituteFrom(AggregateHistory $anAggregateHistory)
    {
        $aPost = static::createEmptyPostWith($anAggregateHistory->getAggregateId());

        foreach ($anAggregateHistory as $anEvent) {
            $aPost->apply($anEvent);
        }

        return $aPost;
    }

    /**
     * @param $anEvent
     */
    private function apply($anEvent)
    {
        $method = 'apply' . ClassFunctions::short($anEvent);
        $this->$method($anEvent);
    }

    private function applyPostWasCreated(PostWasCreated $event)
    {
        $this->title = $event->getTitle();
        $this->content = $event->getContent();
    }

//    private function applyPostWasPublished(PostWasPublished $event)
//    {
//        $this->state = static::STATE_PUBLISHED;
//    }
//
//    private function applyPostTitleWasChanged(PostTitleWasChanged $event)
//    {
//        $this->title = $event->getTitle();
//    }
//
//    private function applyPostContentWasChanged(PostContentWasChanged $event)
//    {
//        $this->content = $event->getContent();
//    }

    private function applyCommentWasAdded(CommentWasAdded $event)
    {
        $this->comments[] = Comment::create($event->getCommentId(), $event->getComment());
    }
}