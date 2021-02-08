<?php

require_once __DIR__ . '/../common.php';
require_once __DIR__ . '/../utils.php';

class Scaffold extends Widget {
    public function __construct(
        public Widget $body,
        public String $title,
    ) { }

    public function paintCss(Array $children, Array $styles = []) : Array {
        foreach ($children as $child) {
            if ($child instanceof Element) {
                if ($child instanceof Widget) {
                    $child = $child->createElement();
                }

                $styles = array_merge($styles, $child->styles, $this->paintCss($child->children));
            }
        }

        return $styles;
    }

    public function getScaffoldTheme() : Array {
        return [
            new StyleStrategy(
                name: "body, div, dl, dt, dd, ul, ol, li, h1, h2, h3, h4, h5, h6, pre, form, fieldset, input, textarea, p, blockquote, th, td, html, body",
                styles: [
                    new StyleValue(CssTags::Margin, 0),
                    new StyleValue(CssTags::Padding, 0),
                ]
            ),
            new StyleStrategy(
                name: "table",
                styles: [
                    new StyleValue(CssTags::BorderSpacing, 0),
                    new StyleValue(CssTags::BorderCollapse, CssTags::Collapse),
                ]
            ),
            new StyleStrategy(
                name: "fieldset, img",
                styles: [
                    new StyleValue(CssTags::Border, 0),
                ]
            ),
            new StyleStrategy(
                name: "input, textarea, button, select, a",
                styles: [
                    new StyleValue("-webkit-tap-highlight-color", CssTags::Transparent),
                ]
            ),
            new StyleStrategy(
                name: "*",
                styles: [
                    new StyleValue(CssTags::Cursor, CssTags::Default),
                    new StyleValue(CssTags::BoxSizing, CssTags::BorderBox),
                ]
            ),
            new StyleStrategy(
                name: "html",
                styles: [
                    new StyleValue(CssTags::Position, CssTags::Relative),
                    new StyleValue(CssTags::Height, Mea::pr(100)),
                ]
            ),
            new StyleStrategy(
                name: "body",
                styles: [
                    new StyleValue(CssTags::Position, CssTags::Fixed),
                    new StyleValue(CssTags::Top, 0),
                    new StyleValue(CssTags::Left, 0),
                    new StyleValue(CssTags::Height, Mea::pr(100)),
                    new StyleValue(CssTags::Width, Mea::pr(100)),
                ]
            ),
        ];
    }

    public function createElement() : Element {
        $body = $this->body->createElement();
        $buffer = $this->paintCss([ 
            new Element('', styles: $this->getScaffoldTheme()), 
            $body, 
        ]);
        $buffer = array_unique($buffer);

        return new Element(
            name: 'html',
            children: [
                new Element(
                    name: 'head',
                    children: [
                        new Element(
                            isClose: true,
                            name: 'meta',
                            tags: [
                                new ElementTag('name', 'viewport'),
                                new ElementTag('content', 'width=device-width, initial-scale=1, user-scalable=no'),
                            ]
                        ),
                        new Element(
                            name: 'title',
                            children: [ new TextPaint($this->title) ],
                        ),
                        new Element(
                            name: 'style',
                            children: [ new TextPaint(PaintUtil::bufferPaint($buffer, separator: ' ')) ],
                        ),
                    ],
                ),
                new Element(
                    name: 'body',
                    children: [ $body ],
                ),
            ] ,
        );
    }
}