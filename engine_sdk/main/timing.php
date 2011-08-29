<?
/*
  
  SoulEngine Timing Library
  
  2009 ver 0.1
  
  Dim-S Software (c) 2009
		
		classes:
		TTimer,TTimerEx
		
		functions:
		setTimer, setTimeout
		
  Библиотека для для работы с таймерами и тайм линиями.
  
*/

// класс для выполнения фоновых процедур
/*class IdleEvent {

	static function register($code, $once = true){
		
		$GLOBALS['__IdleEvent'][$code] = $once;
	}
	
	static function unRegister($code){
		
		unset($GLOBALS['__IdleEvent'][$code]);
	}
	
	static function start(){
		
		idle_enable(true);
	}
	
	static function stop(){
		
		idle_enable(false);
	}
	
	static function call(){
		
		$toEnable = false;
		if (isset($GLOBALS['__IdleEvent'])){
			$toEnable = true;
			foreach ($GLOBALS['__IdleEvent'] as $code=>$once){
				
				if ($once)
					self::unRegister($code);
				
				$toEnable = $toEnable && !$once;
				eval($code);
			}
		}
		
		idle_enable(false);
	}
	
	static function callCode($code){
		
		self::register($code);
		self::start();
	}
}*/

class TTimer extends TControl{
	public $class_name = __CLASS__;
}

class TTimerEx extends TPanel{
	
	public $class_name_ex = __CLASS__;
	#public $time_out = true;
	public $_timer;
	#public $var_name = ''; // название переменной которая освобождается после отработки таймера
	#public $func_name = ''; // название функции которую нужно выполнить после отработки таймера
	#public $func_arguments = array(); // аргументы функции...
	#public $eval_str = '';
	
	#event onTimer 
	
	static function doTimer($self){
		
		$self = cntr_owner($self);
		$props = TComponent::__getPropExArray($self);
		
		// надо сразу избавляться от продолжения таймера, иначе баг =)
		if ($props['time_out']){
			$obj = _c($self);
			$obj->timer->enabled = false;
		}
		
		if ($props['ontimer']){
			if ($props['workbackground']){
				//pre("eval(".$props['ontimer']."(".$self.");); IdleEvent::start(); _empty");
				$bw = new Thread;
				$bw->onWork = $props['ontimer'].'('.$self.');';
				$bw->priority = $props['priority'];
				$bw->start();
				//IdleEvent::register($props['ontimer']."(".$self.");");
				//IdleEvent::start();
			} else {
				eval($props['ontimer'] . '('.$self.');');
			}
		}
		
		if ($props['func_name']){
			
			
			if ($props['checkresult']){
				eval('$result = '.$props['func_name'] . ';');
				if ( $result===true ){
					
					$obj = _c($self);
					//$obj->timer->enabled = false;
					$obj->free();
				}
			}
			else
				eval($props['func_name'] . ';');
		}
		
		if ($props['freeonend']){
			
			$obj->free();
		}
	}
	
	public function __construct($onwer=nil, $init=true, $self=nil){
		parent::__construct($onwer,$init,$self);
		
		if ($init){
			$this->timer->enabled = false;
		}
		
		$this->__setAllPropEx();
	}
	
	function get_timer(){
		
		if (!$this->timer_self){
			$this->_timer = new TTimer($this);
			$this->_timer->name = 'timer';
			$this->_timer->onTimer = 'TTimerEx::doTimer';
			$this->timer_self = $this->_timer->self;
		} else {
			$this->_timer = c($this->timer_self);
		}
		
		return $this->_timer;
	}
	
	public function set_enable($v){
		$this->timer->enabled = $v;
	}
	
	public function get_enable(){
		return $this->timer->enabled;
	}
	
	public function set_enabled($v){
		$this->enable = $v;
	}
	
	public function get_enabled(){
		return $this->enable;
	}
	
	public function set_interval($v){
		$this->timer->interval = $v;
	}
	
	public function get_interval(){
		return $this->timer->interval;
	}
	
	public function get_repeat(){
		return !$this->time_out;
	}
	
	public function set_repeat($v){
		$this->time_out = !$v;
	}
	
	public function start(){
		$this->enabled = true;
		
	}
	
	public function stop(){
		$this->enabled = false;
	}
	
	public function pause(){
		$this->enabled = !$this->enabled;
	}
	
	public function go(){$this->start();}
}


// аналог функции setTimeout из Javascript
// тайминг выполняется единожды...
function setTimeout($interval,$func, $background = false){
	
	$timer = new TTimerEx();
	$timer->interval  = $interval;
	$timer->func_name = $func;
	$timer->time_out  = true;
	$timer->background = $background;
	$timer->freeOnEnd = true;
	$timer->enable = true;
	return $timer;
}

function setThreadTimer($interval, $func){
	
	$add_str = '; setThreadTimer('.$interval.',\''.addslashes($func).'\');';	
	setTimeout($interval, $func.$add_str, true);
}

// аналог функции setTimer
function setTimer($interval,$func, $background = false){
	
	$timer = new TTimerEx();
	$timer->interval  = $interval;
	$timer->func_name = $func;
	$timer->time_out  = false;
	$timer->background = $background;
	$timer->enable = true;
	//pre($func);
	return $timer;
}

function setTimerEx($interval,$func){
	$tim = setTimer($interval, $func);
	$tim->checkResult = true;
	return $tim;
}

function setInterval($interval, $func, $background = false){
	return setTimer($interval, $func, $background);
}

function setBackTimeout($interval, $func){
	return setTimeout($interval, $func, true);
}

function setBackTimer($interval, $func){
	return setTimeout($interval, $func, true);
}

?>