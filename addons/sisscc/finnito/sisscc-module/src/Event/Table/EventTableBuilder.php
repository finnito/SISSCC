<?php namespace Finnito\SissccModule\Event\Table;

use Anomaly\Streams\Platform\Ui\Table\TableBuilder;

class EventTableBuilder extends TableBuilder
{

    /**
     * The table views.
     *
     * @var array|string
     */
    protected $views = [];

    /**
     * The table filters.
     *
     * @var array|string
     */
    protected $filters = [];

    /**
     * The table columns.
     *
     * @var array|string
     */
    protected $columns = [
        "name",
        "date" => [
            "wrapper" => "{value.date}",
            "value" => [
                "date" => "{{entry.date|date('Y-m-d')}}",
            ]
        ],
        "public" => [
            "wrapper" => "<span class='tag tag-sm {value.cls}'>{value.publicText}</span>",
            "value" => [
                "cls" => "entry.publicLabelClass()",
                "publicText" => "entry.publicLabelText()",
            ]
        ],
        "links" => [
            "wrapper" => "<a target='_blank' class='tag tag-sm tag-info' href='/{value.slug}/input'>Admin Input</a> <a target='_blank' class='tag tag-sm tag-info' href='/{value.slug}'>Public Scoreboard</a>",
            "value" => [
                "slug" => "entry.slug",
            ]
        ],
    ];

    /**
     * The table buttons.
     *
     * @var array|string
     */
    protected $buttons = [
        'edit'
    ];

    /**
     * The table actions.
     *
     * @var array|string
     */
    protected $actions = [
        'delete'
    ];

    /**
     * The table options.
     *
     * @var array
     */
    protected $options = [];

    /**
     * The table assets.
     *
     * @var array
     */
    protected $assets = [];

}
