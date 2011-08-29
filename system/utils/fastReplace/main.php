<?

class ev_btn_Start {
    
    static function onClick(){
        
        if (confirm(t('Are you shure to start?')))
        master_fastReplace::replace(c('c_useall')->checked,
                                    c('c_case')->checked,
                                    c('e_find')->text,
                                    c('e_replace')->text);
    }
}