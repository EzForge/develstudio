<?


class master_fastReplace {
    
    
    static function replace($to_all, $match_case, $find, $replace){
        
        global $_FORMS, $projectFile, $formSelected, $fmMain, $fmEdit;
        
        $x_formSelected = $formSelected;
        
        lockWindowUpdate($fmMain);
        myUtils::saveForm();
        $dir = dirname($projectFile);
        $a_count = 0;
        
        if ($to_all){
            foreach ($_FORMS as $form){
                
                myUtils::loadForm($form);
                myUtils::saveForm();
                
                $components = $fmEdit->componentList;
                foreach ($components as $el){
                    if ($el->name)
                    if ($match_case)
                        $el->text = str_replace($find,$replace,$el->text, $count);
                    else
                        $el->text = str_ireplace($find,$replace,$el->text, $count);
                }
                
                $a_count += (int)$count;
            }
            
            myUtils::loadForm($_FORMS[$x_formSelected]);
            
        } else {
                
                $components = $fmEdit->componentList;
                foreach ($components as $el){
                    if ($el->name)
                    if ($match_case)
                        $el->text = str_replace($find,$replace,$el->text, $count);
                    else
                        $el->text = str_ireplace($find,$replace,$el->text, $count);
                }
                myUtils::saveForm();
                $a_count = (int)$count;
        }
        
        myUtils::loadForm($_FORMS[$formSelected]);
        lockWindowUpdate(0);
        message_beep(MB_OK);
        message(t('There were %s substitutions',$a_count));
    }
    
    static function open($self){
        
        c('mst_fastReplace')->showModal();
    }
}