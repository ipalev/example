<?

namespace Its\Lib {

    class PagenManager
    {
        private
            $paginationCode,
            $contentMarker,
            $paginationMarker;

        public function __construct($pagerTitle) {
            $this->paginationCode = trim($pagerTitle);
            $this->contentMarker = '<!-- content-'.$this->paginationCode.'-container -->';
            $this->paginationMarker = '<!-- pagination-'.$this->paginationCode.'-container -->';
        }

        public function getPaginationCode(){
            return $this->paginationCode;
        }

        public function getContentMarker(){
            return $this->contentMarker;
        }

        public function getPaginationMarker(){
            return $this->paginationMarker;
        }

        public function beginContent() {
            echo $this->getContentMarker();
        }

        public function endContent() {
            echo $this->getContentMarker();
        }

        public function beginPagination() {
            echo $this->getPaginationMarker();
        }

        public function endPagination() {
            echo $this->getPaginationMarker();
        }

        public function cut(){
            global $APPLICATION;
            $request = \Bitrix\Main\Context::getCurrent()->getRequest();
            if ( $request->get('pagination_type') === $this->paginationCode ) {

                $additionalContent = [];
                foreach (GetModuleEvents("its_lib", "beforeAjaxPagenResponse", true) as $arEvent) {
                    $addContent = [];
                    $bEventRes = ExecuteModuleEventEx($arEvent, [$this->paginationCode, &$addContent]);

                    if(is_array($addContent) && !empty($addContent)) {
                        foreach ($addContent as $key => $value) {
                            $additionalContent[$key] = $value;
                        }
                    }
                }

                $content = $APPLICATION->EndBufferContentMan();

                list(, $items) = explode($this->contentMarker, $content);
                list(, $pagination) = explode($this->paginationMarker, $content);

                die(json_encode([
                    'items' => $items,
                    'pagination' => $pagination,
                    'additional_content' => $additionalContent,
                ]));
            }
        }
    }

}
