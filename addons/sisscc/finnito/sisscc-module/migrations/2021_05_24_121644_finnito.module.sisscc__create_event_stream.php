<?php

use Anomaly\Streams\Platform\Database\Migration\Migration;

class FinnitoModuleSissccCreateEventStream extends Migration
{

    /**
     * This migration creates the stream.
     * It should be deleted on rollback.
     *
     * @var bool
     */
    protected $delete = true;

    protected $fields = [
        "name" => "anomaly.field_type.text",
        "slug" => [
            "type" => "anomaly.field_type.slug",
            "config" => [
                "type" => "-",
                "lowercase" => true,
            ],
        ],
        "date" => [
            "type" => "anomaly.field_type.datetime",
            "config" => [
                "mode" => "date",
                "date_format" => "Y/m/d",
                "picker" => "false",
            ],
        ],
        "public" => [
            "type" => "anomaly.field_type.boolean",
            "config" => [
                "on_text" => "Public",
                "off_text" => "Private",
            ],
        ],
        "top_x_teams" => [
            "type"   => "anomaly.field_type.integer",
            "config" => [
                "default_value" => 3,
                "separator" => "",
            ]
        ],
        "leaderboard_refresh_interval" => [
            "type"   => "anomaly.field_type.integer",
            "config" => [
                "default_value" => 10000,
                "separator" => "",
            ]
        ],
        "results" => "visiosoft.field_type.json",
    ];

    /**
     * The stream definition.
     *
     * @var array
     */
    protected $stream = [
        'slug' => 'event',
        'title_column' => 'name',
        'translatable' => false,
        'versionable' => false,
        'trashable' => false,
        'searchable' => false,
        'sortable' => false,
    ];

    /**
     * The stream assignments.
     *
     * @var array
     */
    protected $assignments = [
        'name' => [
            'required' => true,
        ],
        'slug' => [
            'unique' => true,
            'required' => true,
        ],
        "date",
        "public",
        "top_x_teams",
        "leaderboard_refresh_interval",
        "results",
    ];
}
