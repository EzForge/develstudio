<?

class ev_fmProjectOptions_list {
    
    function onClick($self){
        
        $list = c($self);
        $name = $list->inText;
        if ( file_exists(DOC_ROOT.'/../php/modules/help/'.basenameNoExt($name).'.html'))
        c('fmProjectOptions->mod_desc')->navigate( DOC_ROOT.'/../php/modules/help/'.basenameNoExt($name).'.html'  );
        else
        c('fmProjectOptions->mod_desc')->html = t('Нет описания.');
    }
}