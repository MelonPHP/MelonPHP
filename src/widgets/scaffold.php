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

    public function createElement() : Element {
        $body = $this->body->createElement();
        $buffer = $this->paintCss([ $body ]);
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