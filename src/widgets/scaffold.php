<?php

class Scaffold extends Widget {
    public function createElement() : Element {
        return new Element(
            name: 'html',
            styles: [
                new StyleStrategy(
                    name: '#'.$id,
                    styles: [ $this->padding ],
                ),
            ],
            children: [ $this->child ] ,
        );
    }
}