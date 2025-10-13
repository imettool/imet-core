<?php

/*
 * Copyright (C) 2025 European Union
 * This program is free software: you can redistribute it and/or modify it under the terms of the
 * EUROPEAN UNION PUBLIC LICENCE v. 1.2 as published by the European Union.
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied
 * warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the EUROPEAN UNION PUBLIC LICENCE v. 1.2 for
 * further details. You should have received a copy of the EUROPEAN UNION PUBLIC LICENCE v. 1.2. along with this program.
 * If not, see <https://joinup.ec.europa.eu/collection/eupl/eupl-text-eupl-12 >.
 */

namespace ImetCore\Models\Imet\Components\Modules;

use ImetCore\Helpers\Template;
use Wa72\HtmlPageDom\Helpers;
use Wa72\HtmlPageDom\HtmlPageCrawler;

trait InjectInView
{
    /**
     * Inject marine/terrestre icon to predefined criteria (EDIT mode with Vue)
     */
    public static function injectIconToPredefinedCriteriaWithVue($icon_type, $view, $vue_if): string
    {
        $dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
        foreach ($dom->filter('tbody') as $tbody) {
            $body_dom = HtmlPageCrawler::create($tbody);
            $td = $body_dom->filter('tr.module-table-item td')->eq(0);
            $td->setStyle('display', 'flex');
            $td->setStyle('align-items', 'center');
            $td->setInnerHtml(
                '<div v-if='.$vue_if.'>
                        '.Template::module_scope($icon_type).
                '</div>&nbsp;&nbsp;'
                .$td->getInnerHtml());
            $td->children()->last()->setStyle('flex-grow', '1');
        }

        return $dom->saveHTML();
    }

    /**
     * Inject marine/terrestre icon to predefined criteria (SHOW mode)
     */
    public static function injectIconToPredefinedCriteria($icon_type, $view, $predefined_with_icon): string
    {
        $dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
        foreach ($dom->filter('tbody') as $tbody) {
            $tr_dom = HtmlPageCrawler::create($tbody)->filter('tr.module-table-item');
            foreach ($tr_dom as $tr) {
                $td = HtmlPageCrawler::create($tr)->filter('td')->first();
                $div = HtmlPageCrawler::create($td)->filter('div.field-preview');
                $td->setStyle('display', 'flex');
                $td->setStyle('align-items', 'center');
                if (in_array(trim($div->getInnerHtml()), $predefined_with_icon)) {
                    $td->setInnerHtml(
                        '<div>'.Template::module_scope($icon_type).'</div>&nbsp;&nbsp;'
                        .$td->getInnerHtml());
                }
                $td->children()->last()->setStyle('flex-grow', '1');
            }
        }

        return $dom->saveHTML();
    }

    public static function injectIconToGroups($view, $marine_groups, $terrestrial_groups): string
    {
        $dom = HtmlPageCrawler::create(Helpers::trimNewlines($view));
        $titles = $dom->filter('h5');
        foreach ($titles as $title) {
            $title_dom = HtmlPageCrawler::create($title);
            $title_dom->setStyle('display', 'flex');
            $title_dom->setStyle('align-items', 'center');
            if (in_array($title_dom->text(), $marine_groups)) {
                $title_dom->setInnerHtml(
                    '<div>'.Template::module_scope(static::MARINE).'&nbsp;&nbsp;</div>'
                    .$title_dom->getInnerHtml());
            } elseif (in_array($title_dom->text(), $terrestrial_groups)) {
                $title_dom->setInnerHtml(
                    '<div>'.Template::module_scope(static::TERRESTRIAL).'&nbsp;&nbsp;</div>'
                    .$title_dom->getInnerHtml());
            } else {
                $title_dom->setInnerHtml(
                    '<div>'.Template::module_scope(static::MARINE).Template::module_scope(static::TERRESTRIAL).'&nbsp;&nbsp;</div>'
                    .$title_dom->getInnerHtml());
            }
        }

        return $dom->saveHTML();
    }
}
