<?php

namespace FFMpeg\Filters\Video;

use FFMpeg\Media\Video;
use FFMpeg\Format\VideoInterface;

/**
 * Making a black fadout
 *
 * Class FadeoutFilter
 * @package FFMpeg\Filters\Video
 */
class FadeoutFilter implements VideoFilterInterface
{
    /**
     * Beginning of the fadout
     * @var int
     */
    private $fromSc;

    /**
     * Duration of the fadout
     * @var int
     */
    private $durationSc;

    /**
     * Frame rate of the video
     * @var int
     */
    private $frameRate;

    private $priority;

    /**
     * Constructor
     *
     * @param int $fromSc
     * @param int $durationSc
     * @param int $frameRate
     * @param int $priority
     */
    public function __construct($fromSc, $durationSc, $frameRate = 25, $priority = 0)
    {
        $this->fromSc = $fromSc;
        $this->durationSc = $durationSc;
        $this->frameRate = $frameRate;
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
        $fromFrame = $this->fromSc * $this->frameRate;
        $durationFrame = $this->durationSc * $this->frameRate;

        return array('-vf', "fade=out:$fromFrame:$durationFrame");
    }
}
