<?php namespace Finnito\SissccModule;

use Anomaly\Streams\Platform\Addon\Module\Module;

class SissccModule extends Module
{

    /**
     * The navigation display flag.
     *
     * @var bool
     */
    protected $navigation = true;

    /**
     * The addon icon.
     *
     * @var string
     */
    protected $icon = 'glyphicons glyphicons-global';

    /**
     * The module sections.
     *
     * @var array
     */
    protected $sections = [
        'event' => [
            'buttons' => [
                'new_event',
            ],
        ],
    ];

}
