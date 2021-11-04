<?php

namespace Its\Lib;

class BlogParser
{
    //types
    public const PLAIN = 1;
    public const SNIPPET = 2;
    public const SNIPPET_INDEPENDENT = 3;
    public const INSERT = 4;

    private $rawString = '';
    private $userConfig = [];
    private $finalLayout = '';
    private $separatedParts = [];
    private $patterns = [];
    private $insertPatterns = [];
    private $independenciesDetector = [];

    /**
     * Example:
     * <pre>
     * BlogParser::PLAIN => [
     *     '##TEXT##' => '<section class="page-article">##INSERT_LEFT_IMAGE##<div class="page-article__body">##TEXT##</div>##INSERT_RIGHT_IMAGE##</div>',
     * ],
     * BlogParser::SNIPPET => [
     *     '[FLEX]##CONTENT##[/FLEX]' => '<div class="flex">##CONTENT##</div>',
     * ],
     * BlogParser::SNIPPET_INDEPENDENT => [
     *     '[SLIDER_1="##TITLE##"]' => '<div class="my_awesome_slider"><img src="picture1.jpg"><img src="picture2.jpg"><img src="picture3.jpg"></div>',
     *     '[SLIDER_2="##TITLE##"]' => '<ul class="my_super_slider"> <li><img src="picture1.jpg"></li> <li><img src="picture2.jpg"></li> <li><img src="picture3.jpg"></li> </ul>',
     * ],
     * BlogParser::INSERT => [
     *     '[LEFT]##LEFT_IMAGE##[/LEFT]' => '<div class="left-super-background" style="background-image: url(##LEFT_IMAGE##)"></div>',
     *     '[RIGHT]##RIGHT_IMAGE##[/RIGHT]' => '<div class="left-super-background" style="background-image: url(##RIGHT_IMAGE##)"></div>',
     * ]
     * </pre>
     *
     * @throws \Exception
     *
     * An Exception is possible if more than one PLAIN-type using or no least one SNIPPET used
     */
    public function __construct(array $parserConfig, $userString){
        //validate config
        if(
            ( !isset($parserConfig[self::SNIPPET]) || count($parserConfig[self::SNIPPET]) < 1 ) &&
            ( !isset($parserConfig[self::SNIPPET_INDEPENDENT]) || count($parserConfig[self::SNIPPET_INDEPENDENT]) < 1 )
        ) throw new \Exception('Need at least one snippet!');
        if( isset($parserConfig[self::PLAIN]) && count($parserConfig[self::PLAIN]) > 1 ) throw new \Exception('Only one PLAIN-type allowed!');

        $this->userConfig = $parserConfig;
        $this->rawString = $userString;

        $stringDelimiters = [];
        foreach ($parserConfig as $type => $pairs) {
            if( $type !== self::SNIPPET_INDEPENDENT ) continue;

            foreach ($pairs as $rule => $replacer) {
                $finder = preg_replace('/(##.+?##)/is', '.+?', preg_quote($rule), -1, $cnt);
                if($cnt < 1) continue;
                $this->independenciesDetector[] = $finder;
                $stringDelimiters[] = $finder;
            }
        }

        $this->separatedParts =
            isset($this->userConfig[self::SNIPPET_INDEPENDENT]) && !empty($this->userConfig[self::SNIPPET_INDEPENDENT]) ?
                preg_split('#('.implode('|', $stringDelimiters).')#is', $this->rawString, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE) : [$this->rawString];

        foreach ($parserConfig as $type => $pairs) {
            if($type == self::PLAIN) continue;

            foreach ($pairs as $snippet => $replacer) {
                preg_match_all('/##(.*?)##/s', $snippet, $matches);
                $snippet = preg_quote($snippet);
                $snippet = str_replace('\#\#', '##', $snippet);
                $newString = $replacer;
                foreach ($matches[0] as $order => $match) {
                    $snippet = str_replace($match, '(.+?)', $snippet);
                    $newString = str_replace($match, '$' . ($order + 1), $newString);
                }

                $pattern = '#' . $snippet . '#is';
                if($type == self::INSERT) {
                    $this->insertPatterns[$pattern] = $replacer;
                } else {
                    $this->patterns[$pattern] = $newString;
                }
            }
        }
        $this->buildLayout();
    }

    private function buildLayout(){
        foreach ($this->separatedParts as &$piece) {
            $replaced = preg_replace(array_keys($this->patterns), $this->patterns, $piece);

            $insert = [];
            if( !empty($this->userConfig[self::INSERT]) ) {
                foreach ($this->insertPatterns as $_pattern => $_replace) {

                    preg_match($_pattern, $replaced, $urlMatch);
                    foreach ($this->userConfig[self::INSERT] as $parameter => $_trash) {

                        if(preg_match($_pattern, $parameter, $paramMatch)) {
                            $insert[] = [
                                'from' => preg_replace('/##(.*)##/i', '##INSERT_$1##', $paramMatch[1]),
                                'to' => $urlMatch[1] ? str_replace($paramMatch[1], $urlMatch[1], $_replace) : ''
                            ];
                            unset($urlMatch);
                        }
                    }

                    $replaced = preg_replace($_pattern, '', $replaced);
                }
            }

            $isPlain = true;
            foreach ($this->independenciesDetector as $finder) {
                if( !preg_match('#^'.$finder.'$#is', trim($piece)) ) continue;
                $isPlain = false;
                break;
            }

            if($isPlain) {
                $plainPattern = array_keys($this->userConfig[self::PLAIN])[0];
                $this->finalLayout .= preg_replace('/('.$plainPattern.')/is', $replaced, $this->userConfig[self::PLAIN][$plainPattern]);
            } else {
                $this->finalLayout .= $replaced;
            }

            if( !empty($insert) ) {
                foreach ($insert as $one) {
                    $this->finalLayout = str_replace($one['from'], $one['to'], $this->finalLayout);
                }
            }

        }
    }

    public function getLayout() {
        return $this->finalLayout;
    }
}