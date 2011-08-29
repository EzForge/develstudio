<?


class ev_fmBuildCompleted_btn_run {
    
    
    static function onClick($self){
        
        run(c('e_filename')->text);
    }
}

class ev_fmBuildCompleted_btn_dir {
    
    
    static function onClick($self){
        
        run(dirname(c('e_filename')->text));
    }
}