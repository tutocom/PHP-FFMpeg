<?php

/*
 * Author: Quentin
 * Date: 27/03/2015
 * Custom filter
 */

namespace Tuto\FFMpeg\Filters\Video;

use FFMpeg\Filters\Video as FFMpegFilters;
use FFMpeg\Media\Video;
use FFMpeg\Format\VideoInterface;

/**
 * Adjust the intra-frame compression for each kind of gop's images (I,P and B)
 *
 * Class PartitionsFilter
 * @package Tuto\FFMpeg\Filters\Video
 */
class PartitionsFilter implements FFMpegFilters\VideoFilterInterface
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
