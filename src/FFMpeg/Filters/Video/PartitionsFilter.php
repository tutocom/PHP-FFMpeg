<?php

namespace FFMpeg\Filters\Video;

use FFMpeg\Media\Video;
use FFMpeg\Format\VideoInterface;

/**
 * Adjust the intra-frame compression for each kind of gop's images (I,P and B)
 *
 * Class PartitionsFilter
 * @package FFMpeg\Filters\Video
 */
class PartitionsFilter implements VideoFilterInterface
{
    /**
     * @var int
     */
    private $partI;

    /**
     * @var int
     */
    private $partP;

    /**
     * @var int
     */
    private $partB;

    private $priority;

    /**
     * Constructor
     *
     * @param int $partI
     * @param int $partP
     * @param int $partB
     * @param int $priority
     */
    public function __construct($partI, $partP, $partB, $priority = 0)
    {
        $this->partI = $partI;
        $this->partP = $partP;
        $this->partB = $partB;
    }

    /**
     * {@inheritdoc}
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * {@inheritdoc}
     */
    public function apply(Video $video, VideoInterface $format)
    {

        if ($format->supportBFrames()) {
            $commands[] = '-partitions';
            $commands[] = '+parti' . $this->partI . 'x' . $this->partI . '+partp' . $this->partP . 'x' . $this->partP . '+partb' . $this->partB . 'x' . $this->partB;
        }

        return $commands;
    }
}
