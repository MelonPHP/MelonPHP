<?php

function Px($value) : string {
   return $value.Px;
 }

function Fr($value) : string {
  return $value.Fr;
}

function Pr($value) : string {
  return $value.Pr;
}

function Em($value) : string {
  return $value.Em;
}

function Hex($value) : string {
  return "#".$value;
}

function Rgb($r, $g, $b) : string {
  return "rgb(".DotL($r, $g, $b).")";
}

function Rgba($r, $g, $b, $a) : string {
  return "rgba(".DotL($r, $g, $b, $a).")";
}

function Url($value) : string {
  return "url(\"".$value."\")";
}

function Minmax($min, $max) : string {
  return "minmax(".$min.", ".$max.")";
}

function Repeat($start, $end) : string {
  return "repeat(".$start.", ".$end.")";
}

function FitContent($start, $end) : string {
  return "fit-content(".$start.", ".$end.")";
}

function SpaceL(...$params) {
  $line = "";
  foreach ($params as $value) {
    $line .= $value." ";
  }
  if (strlen($line) > 1) {
    $line = substr($line, 0, -1);
  }
  return $line;
}

function DotL(...$params) {
  $line = "";
  foreach ($params as $value) {
    $line .= $value.", ";
  }
  if (strlen($line) > 2) {
    $line = substr($line, 0, -2);
  }
  return $line;
}

const AutoFit = "auto-fit";
const Auto = "auto";

const Repeat = "repeat";
const NoRepeat = "no-repeat";

const Inherit = "inherit";

const Contain = "contain";
const Cover = "cover";
const Center = "center";

const None = "none";

const Px = "px";
const Pr = "%";
const Pr100 = "100%";
const Fr = "fr";
const Em = "em";

const White = "white";
const Transparent = "transparent";
const Black = "black";
const Red = "red";
const Blue = "blue";
const Green = "green";
const Gray = "gray";
const Orange = "orange";
const Yellow = "yellow";

const BackgroundImage = "background-image";
const BackgroundColor = "background-color";
const Color = "color";

const BoxShadow = "box-shadow";

const AlignContent = "align-content";
const AlignItems = "align-items";
const AlignSelf = "align-self";

const All = "all";

const Animation = "animation";
const AnimationDelay = "animation-delay";
const AnimationTimingFunction = "animation-timing-function";
const AnimationPlayState = "animation-play-state";
const AnimationName = "animation-name";
const AnimationIterationCount = "animation-iteration-count";
const AnimationFillMode = "animation-fill-mode";
const AnimationDuration = "animation-duration";
const AnimationDirection = "animation-direction"; 

const Background = "background";
const BackgroundSize = "background-size";
const BackgroundRepeat = "background-repeat";
const BackgroundPosition = "background-position";
const BackgroundOrigin = "background-origin";
const BackgroundClip = "background-clip";
const BackgroundBlendMode = "background-blend-mode";
const BackgroundAttachment = "background-attachment";

const Border = "border";
const BorderRadius = "border-radius";
const BorderImage = "border-image";
const BorderImageWwidth = "border-image-width";
const BorderImageSource = "border-image-source";
const BorderImageSlice = "border-image-slice";
const BorderImageRepeat = "border-image-repeat";
const BorderImageOutset = "border-image-outset";
const BorderColor = "border-color";
const BorderCollapse = "border-collapse";

const BorderBottomWidth = "border-bottom-width";
const BorderBottomStyle = "border-bottom-style";
const BorderBottomRightRadius = "border-bottom-right-radius";
const BorderBottomLeftRadius = "border-bottom-left-radius";
const BorderBottomColor = "border-bottom-color";
const BorderBottom = "border-bottom";

const BorderTopWidth = "border-top-width";
const BorderTopStyle = "border-top-style";
const BorderTopRightRadius = "border-top-right-radius";
const BorderTopLeftRadius = "border-top-left-radius";
const BorderTopColor = "border-top-color";
const BorderTop = "border-top";

const BorderLeftWidth = "border-left-width";
const BorderLeftStyle = "border-left-style";
const BorderLeftRightRadius = "border-left-right-radius";
const BorderLeftLeftRadius = "border-left-left-radius";
const BorderLeftColor = "border-left-color";
const BorderLeft = "border-left";

const BorderRightWidth = "border-Right-width";
const BorderRightStyle = "border-Right-style";
const BorderRightRightRadius = "border-right-right-radius";
const BorderRightLeftRadius = "border-right-left-radius";
const BorderRightColor = "border-Right-color";
const BorderRight = "border-Right";

const Bottom = "bottom";
const BreakInside = "break-inside";
const BreakBefore = "break-before";
const BreakAfter = "break-after";
const BoxSizing = "box-sizing";
const BoxSecorationBreak = "box-decoration-break";

const CaptionSide = "caption-side";

const CaretColor = "caret-color";
const Clear = "clear";
const Clip = "clip";
const ColumnCount = "column-count";
const ColumnFill = "column-fill";
const ColumnGap = "column-gap";
const ColumnRule = "column-rule";
const ColumnRuleColor = "column-rule-color";
const ColumnRuleStyle = "column-rule-style";
const ColumnRuleWidth = "column-rule-width";
const ColumnSpan = "column-span";
const ColumnWidth = "column-width";
const Columns = "columns";
const Content = "content";
const CounterIncrement = "counter-increment";
const CounterReset = "counter-reset";
const Cursor = "cursor";

const Direction = "direction";
const Display = "display";

const EmptyCells = "empty-cells";

const Filter = "filter";
const Flex = "flex";
const FlexBasis = "flex-basis";
const FlexDirection = "flex-direction";
const FlexFlow = "flex-flow";
const FlexGrow = "flex-grow";
const FlexShrink = "flex-shrink";
const FlexWrap = "flex-wrap";
const Float = "float";
const Font = "font";
const FontWeight = "font-weight";
const FontSize = "font-size";
const FontFamily = "font-family";
const FontFeatureSettings = "font-feature-settings";
const FontKerning = "font-kerning";
const FontLanguageOverride = "font-language-override";
const FontSizeAdjust = "font-size-adjust";
const FontStretch = "font-stretch";
const FontStyle = "font-style";
const FontSynthesis = "font-synthesis";
const FontVariant = "font-variant";
const FontVariantAlternates = "font-variant-alternates";
const FontVariantCaps = "font-variant-caps";
const FontVariantEastAsian = "font-variant-east-asian";
const FontVariantLigatures = "font-variant-ligatures";
const FontVariantNumeric = "font-variant-numeric";
const FontVariantPosition = "font-variant-position";

const Grid = "grid";
const GridArea = "grid-area";
const GridAutoColumns = "grid-auto-columns";
const GridAutoFlow = "grid-auto-flow";
const GridAutoRows = "grid-auto-rows";
const GridColumn = "grid-column";
const GridColumnEnd = "grid-column-end";
const GridColumnGap = "grid-column-gap";
const GridColumnStart = "grid-column-start";
const GridGap = "grid-gap";
const GridRow = "grid-row";
const GridRowEnd = "grid-row-end";
const GridRowGap = "grid-row-gap";
const GridRowStart = "grid-row-start";
const GridTemplate = "grid-template";
const GridTemplateAreas = "grid-template-areas";
const GridTemplateColumns = "grid-template-columns";
const GridTemplateRows = "grid-template-rows";

const HangingPunctuation = "hanging-punctuation";
const Hyphens = "hyphens";

const ImageRendering = "image-rendering";
const Isolation = "isolation";

const JustifyContent = "justify-content";
const Left = "left";
const LetterSpacing = "letter-spacing";
const LineBreak = "line-break";
const LineHeight = "line-height";
const ListStyle = "list-style";
const ListStyleImage = "list-style-image";
const ListStylePosition = "list-style-position";
const ListStyleType = "list-style-type";

const MixBlendMode = "mix-blend-mode";
const Width = "width";
const MaxWidth = "max-width";
const MinWidth = "min-width";
const Height = "height";
const MaxHeight = "max-height";
const MinHeight = "min-height";
const Margin = "margin";
const MarginLeft = "margin-left";
const MarginRight = "margin-right";
const MarginTop = "margin-top";
const MarginBottom = "margin-bottom";

const ObjectFit = "object-fit";
const ObjectPosition = "object-position";
const Opacity = "opacity";
const Order = "order";
const Orphans = "orphans";
const Outline = "outline";
const OutlineColor = "outline-color";
const OutlineOffset = "outline-offset";
const OutlineStyle = "outline-style";
const OutlineWidth = "outline-width";
const Overflow = "overflow";
const OverflowWrap = "overflow-wrap";
const OverflowX = "overflow-x";
const OverflowY = "overflow-y";

const Padding = "padding";
const PaddingLeft = "padding-left";
const PaddingRight = "padding-right";
const PaddingTop = "padding-top";
const PaddingBottom = "padding-bottom";
const PageBreakAfter = "page-break-after";
const PageBreakBefore = "page-break-before";
const PageBreakInside = "page-break-inside";
const Perspective = "perspective";
const PerspectiveOrigin = "perspective-origin";
const PointerEvents = "pointer-events";
const Position = "position";

const Quotes = "quotes";

const Resize = "resize";
const Right = "right";

const ScrollBehavior = "scroll-behavior";

const TabSize = "tab-size";
const TableLayout = "table-layout";
const TextAlign = "text-align";
const TextAlignLast = "text-align-last";
const TextCombineUpright = "text-combine-upright";
const TextDecoration = "text-decoration";
const TextDecorationColor = "text-decoration-color";
const TextDecorationLine = "text-decoration-line";
const TextDecorationStyle = "text-decoration-style";
const TextIndent = "text-indent";
const TextJustify = "text-justify";
const TextOrientation = "text-orientation";
const TextOverflow = "text-overflow";
const TextShadow = "text-shadow";
const TextTransform = "text-transform";
const TextUnderlinePosition = "text-underline-position";
const Top = "top";
const Transform = "transform";
const TransformOrigin = "transform-origin";
const TransformStyle = "transform-style";
const Transition = "transition";
const TransitionDelay = "transition-delay";
const TransitionDuration = "transition-duration";
const TransitionProperty = "transition-property";
const TransitionTimingFunction = "transition-timing-function";

const UnicodeBidi = "unicode-bidi";
const UserSelect = "user-select";

const VerticalAlign = "vertical-align";
const Visibility = "visibility";

const WhiteSpace = "white-space";
const Widows = "widows";
const WordBreak = "word-break";
const WordSpacing = "word-spacing";
const WordWrap = "word-wrap";
const WritingMode = "writing-mode";
const ZIndex = "z-index";