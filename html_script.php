<?

require_once("html_core.php");

class HtmlScript extends HtmlElement
{
  private $SrcArgument;
  private $Content = " ";
  
  public function __construct() {
    parent::InitializeHtml();
    $this->SrcArgument = (new HtmlArgument)
    ->SetName("src");
  }

  public function SetSrcItem(string $string) {
    $this->SrcArgument->RemoveAllItems();
    $this->SrcArgument->AddChild($string);
    return $this;
  }

  public function SetContent($other) {
    $this->Content = $other;
    return $this;
  }

  public function &GetSizesArgumentLink() : HtmlArgument {
    return $this->SrcArgument;
  }

  public function Generate() : string {
    $argq = $this->GetArgumentsQueue();
    array_push($argq, $this->SrcArgument);
    $argq = array_splice($argq, 3, count($argq) - 1, array());
    return (new HtmlTag("script", $argq, $this->Content))->Generate();
  }
}

?>