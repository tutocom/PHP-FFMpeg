<?php

namespace FFMpeg\Filters\Audio;

use FFMpeg\Media\Audio;

class AudioFilters
{
    protected $media;

    public function __construct(Audio $media)
    {
        $this->media = $media;
    }

    /**
     * Resamples the audio file.
     *
     * @param Integer $rate
     *
     * @return AudioFilters
     */
    public function resample($rate)
    {
        $this->media->addFilter(new AudioResamplableFilter($rate));

        return $this;
    }

    /**
     * @param $percentageVolume
     *
     * @return $this
     */
    public function volume($percentageVolume)
    {
        $this->media->addFilter(new AudioVolumeFilter($percentageVolume));

        return $this;
    }

    /**
     * @param $fromSc
     * @param $durationSc
     *
     * @return $this
     */
    public function audioFadeout($fromSc, $durationSc)
    {
        $this->media->addFilter(new AudioFadeoutFilter($fromSc, $durationSc));

        return $this;
    }
}
