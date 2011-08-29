<?
/*
   класс, который объедин€ет все возможности использовани€ DS Api 
*/


class DSApi {
    
    static function __doStartBeforeFunc(){
        
        foreach((array)$GLOBALS['___startFunctionsBefore'] as $func)
            eval($func.';');
    }
    
    static function __doStartFunc(){
        
        //pre((array)$GLOBALS['___startFunctions']);
        foreach((array)$GLOBALS['___startFunctions'] as $func)
            eval($func.';');
    }
    
    // регистраци€ функции, котора€ должна выполнитьс€ после загрузки всех форм
    static function reg_startFunc($func){
        
        
        $GLOBALS['___startFunctions'][] = $func;
    }
    
    // регистраци€ функции, котора€ должна выполнитьс€ до загрузки всех форм
    static function reg_startFuncBefore($func){
        
        $GLOBALS['___startFunctionsBefore'][] = $func;
    }
    
    // регистрирует функцию дл€ нового типа событи€
    static function reg_eventType($type, $callFunc, $params = array('self'), $class = false){
        
        $type = strtolower($type);
        
        if ($class){
            $GLOBALS['__EVENTS_API_CLASS'][$class][$type] = $callFunc;
            $GLOBALS['__EVENTS_API_PRMS_CLASS'][$class][$type] = $params;
        } else {
            $GLOBALS['__EVENTS_API'][$type] = $callFunc;
            $GLOBALS['__EVENTS_API_PRMS'][$type] = $params;
        }
    }
    
    static function reg_eventParams($type, $params, $class = false){
        
        if ($class)
            $GLOBALS['__EVENTS_API_PRMS_CLASS'][$class][strtolower($type)] = $params;
        else
            $GLOBALS['__EVENTS_API_PRMS'][strtolower($type)] = $params;
    }
    
    static function getEventParams($type, $class = false){
        
        $type = strtolower($type);
        
        if ($class && $GLOBALS['__EVENTS_API_PRMS_CLASS'][$class][$type])
            return '$'.implode(', $',$GLOBALS['__EVENTS_API_PRMS_CLASS'][$class][$type]);
        elseif ($GLOBALS['__EVENTS_API_PRMS'][$type])
            return '$'.implode(', $',$GLOBALS['__EVENTS_API_PRMS'][$type]);
        else
            return '$self';
    }
    
    static function callEvent($self, $params, $type){
        
        return __exEvents::callEventEx($self, $params, $type);
    }
    
    // регистрирует мега глобальную переменную в DS, которую можно использовать без global
    static function reg_glVar($name){
        
        $name = str_ireplace('$','',$name);
        __exEvents::addGlobalVar($name);
    }
    
    // устанавливает контролер дл€ вывода контента
    static function echoController($obj_or_func){
        
        $GLOBALS['__echoController'] = $obj_or_func;
    }
    
    // инициализирует форму по опци€м $info
    static function initForm($fmEdit, $info){
        
        if (!$info) return false;
        
        $fmEdit->constraints->maxwidth = $info['maxwidth'];
        $fmEdit->constraints->minwidth = $info['minwidth'];
        $fmEdit->constraints->maxheight= $info['maxheight'];
        $fmEdit->constraints->minheight= $info['minheight'];
                
        if (isset($info['position']))
            $fmEdit->position = $info['position'];
        if (isset($info['windowState']))
            $fmEdit->windowState = $info['windowState'];
        if (isset($info['formStyle']))
            $fmEdit->formStyle = $info['formStyle'];
        if (isset($info['borderStyle']))
            $fmEdit->borderStyle = $info['borderStyle'];
                            
        if (isset($info['visible'])){
            
            $fmEdit->visible = $info['visible'];
        }
        
        $icons = array();
        if ($info['i_close'] || !isset($info['i_close']))
            $icons[] = 'biSystemMenu';
        if ($info['i_min'] || !isset($info['i_min']))
            $icons[] = 'biMinimize';
        if ($info['i_max'] || !isset($info['i_max']))
            $icons[] = 'biMaximize';
        
        $fmEdit->borderIcons = implode(',',$icons);    
    }
    
    // регистрирует событи€ дл€ компонентов из конфига
    function initFormEx($fmEdit, $name){
        
        global $__config;
        self::initForm($fmEdit, $__config['formsInfo'][$name]);
    }
    
    function initForThread(){
        
        if (!defined('THREAD_TIMER_TICK')){
            
            $TIM = new TTimerEx;
            $TIM->interval = 30;
            $TIM->repeat   = false;
            $TIM->enable   = false;
            define_ex('THREAD_TIMER_TICK', $TIM->self);
        }
        
        v('__exEvents', $GLOBALS['__exEvents']);
        //lockV('__exEvents');
        Thread::addCode('$GLOBALS["__exEvents"] = v("__exEvents"); $GLOBALS["__incCode"] = v("__incCode");');
    }
    
    // нестандартна€ загрузка событий с классами TEvent
    function initEvent($form, $init_funcs = false){
        
        $form_event_load = false;
        $c = component_count($form->self);
        $form_name = strtolower($form->name);
        $form_self = $form->self;
        
        global $__config;
        
        if (is_array(eventEngine::$DATA[$form_name])){
        foreach (eventEngine::$DATA[$form_name] as $obj=>$eventList){
            
            $self  = false;
            if ($obj == '--fmedit'){
                $obj_name = $form_name;
                $self     = $form_self;
                $el       = $form;
            } else {
                
                $obj_name = $form_name .'->'.$obj;
            }
            
            if (is_array($eventList)){
                
                
                if (!$self){    
                    $el = $form->findComponent($obj);
                    $self = $el->self;
                }
                    $GLOBALS['__exEvents'][$self] = array('events'=>$eventList, 'obj_name'=>$obj_name);
                    foreach ((array)$eventList as $x=>$code){
                        
                        unset(eventEngine::$DATA[$form_name][$obj][$x]);
                        if (method_exists('__exEvents',$x))
                            $el->$x = '__exEvents::'.$x;
                        else {
                            $class = $el->className;
							
                            if ($GLOBALS['__EVENTS_API_CLASS'][$class][$x])
                                $el->$x = $GLOBALS['__EVENTS_API_CLASS'][$class][$x];
                            else
                                $el->$x = $GLOBALS['__EVENTS_API'][$x];    
                        }
                        
                        if ($init_funcs)
                        if ($el instanceof TFunction){          
                            if ($el->toRegister)
                                $el->register();
                        }
                        
                        if ($x=='oncreate'){
                            
                            self::reg_startFunc('__exEvents::callCode('.$form->self.',"oncreate");');
                        }
                    }
                    
            }
            
        }
            
        }
        
    }

}