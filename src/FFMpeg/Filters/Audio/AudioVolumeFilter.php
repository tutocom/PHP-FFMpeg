<?php

namespace Tuto\FFMpeg\Filters\Audio;

use FFMpeg\Filters\Audio as FFMpegFilters;
use FFMpeg\Media\Audio;
use FFMpeg\Format\AudioInterface;

/**
 * Allow to adjust volume of video
 *
 * Class AudioVolumeFilter
 * @package Tuto\FFMpeg\Filters\Audio
 */
class AudioVolumeFilter implements FFMpegFilters\AudioFilterInterface
{
    /**
     * Volume in percentage
     *
     * @var string|int
     */
    private $volume;

    private $priority;

    /**
     * @param string|int $volume
     * @param int $priority
     */
    public function __construct($volume = '100', $priority = 0)
    {
        $this->volume = $volume;
        $this->priority = $priority;
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
    public function apply(Audio $audio, AudioInterface $format)
    {
        if ($this->volume >= 0) {
            $vol = 'volume=' . ($this->volume / 100);
        } else {
            $vol = 'volume=1';
        }

        return array('-af', $vol);
    }
}
