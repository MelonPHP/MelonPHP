<?php

class Scaffold extends Widget {
    public function __construct(
        public Element $body,
        public String $title,
    ) { }

    public function paintCss(Element $element, String $buffer = '') : String {
        foreach ($element->children as $child) {
            $result = PaintUtil::bufferPaint($child->styles, separator: ' ');
            $buffer .= $result;
            $buffer .= $this->paintCss($child);
        }

        return $buffer;
    }

    public function createElement() : Element {
        return new Element(
            name: 'html',
            children: [
                new Element(
                    name: 'head',
                    children: [
                        new Element(
                            name: 'meta',
                        ),
                        new Element(
                            name: 'meta',
                        ),
                        new Element(
                            name: 'title',
                            children: [ new TextPaint($this->title) ],
                        ),
                        new Element(
                            name: 'style',
                            children: [ new TextPaint($this->paintCss($this->body)) ],
                        ),
                    ],
                ),
                new Element(
                    name: 'body',
                    children: [ $this->body ],
                ),
            ] ,
        );
    }
}