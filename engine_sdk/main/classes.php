<?
/*
   Base classes
   Author: Dmitriy Zaytsev (c) 2009
 
   Info:
        classes
                TStrings - array of string in VCL
                TStream - abstract class
                TMemoryStream, TFileStream
 
 
*/

global $_c;

  $_c->fmOpenRead       = 0x00;
  $_c->fmOpenWrite      = 0x01;
  $_c->fmOpenReadWrite  = 0x02;

  $_c->fmShareExclusive = 0x10;
  $_c->fmShareDenyWrite = 0x20;
  $_c->fmShareDenyRead  = 0x30; // write-only not supported on all platforms
  $_c->fmShareDenyNone  = 0x40;
  
  $_c->fmCreate = 0xFFFF;

///////////////////////////////////////////////////////////////////////////////
///                             TStrings                                    ///
///////////////////////////////////////////////////////////////////////////////
class TStrings extends TObject{
    
    public $class_name = __CLASS__;
    public $parent_object = nil;
    
    function __construct($init = true){
        if ($init)
            $this->self = tstrings_create();
    }
    
    // properties ...
    // -------------------------------------------------------------------------
    function get_text(){
        return tstrings_get_text($this->self);
    }
    
    function set_text($text){
        if (is_array($text))
            $text = implode(_BR_, $text);
        
        $this->clear();
        tstrings_set_text($this->self,$text);
    }
    
    function get_itemIndex(){
        return tstrings_item_index($this->parent_object,null);
    }
    
    function set_itemIndex($n){
        tstrings_item_index($this->parent_object,$n);
    }
    
    function get_count(){
        return substr_count($this->text,_BR_);
    }
    // -------------------------------------------------------------------------
    
    function loadFromFile($filename){
        $this->text = file_get_contents(shortName($filename));
    }
    
    function saveToFile($filename){
        file_put_contents($filename,$this->text);
    }
    
    function assign(object $strings){
        $this->text = $strings->text;
    }
    
    function addStrings(object $strings){
        $this->text = $this->text . $strings->text;
    }
    
    function append($new){
        $i = $this->itemIndex;
            $this->text = $this->text . $new._BR_;
        $this->itemIndex = $i;
    }
    
    function add($new){
        $this->append($new);
        return $this->count-1;
    }
    
    function delete($index){
        $arr = explode(_BR_, $this->text);
        unset($arr[$index]);
        $this->text = implode(_BR_, $arr);
    }
    
    function exchange($index, $index2){
        
        $arr = explode(_BR_, $this->text);
        $tmp = $arr[$index];
        $arr[$index] = $arr[$index2];
        $arr[$index2] = $tmp;
        $this->text = implode(_BR_, $arr);
    }
    
    function clear(){
        
        tstrings_clear($this->self); // fix
    }
    
    function free(){
        tstrings_free($this->self);
    }
    
    function get_lines(){
        
        $lines = explode(_BR_, $this->text);
        return $lines;
    }
    
    function get_strings(){
        return $this->get_lines();
    }
    
    function setLine($index, $name){
        
        tstrings_setline($this->self, $index, $name);
        /*$id = $this->itemIndex;
        $lines = $this->lines;
        if (isset($lines[$index]))
            $lines[$index] = $name;
        $this->text = implode(_BR_, $lines);
        $this->itemIndex = $id;*/
    }
    
    function getLine($index){
        $lines = $this->lines;
        if (isset($lines[$index]))
            return $lines[$index];
        
        return false;
    }
    
    function setArray($array){
        
        $this->text = implode(_BR_, (array)$array);
    }
    
    function get_selected(){
        $lines = $this->lines;
        
        if ($this->itemIndex > -1)
            return $lines[$this->itemIndex];
        else
            return false;
    }
    
    function set_selected($v){
        $lines = $this->lines;
        
        $index = array_search($v, $lines);
        
        if ($index!==false)
            $this->itemIndex = $index;
        else
            $this->itemIndex = -1;
    }
    
    function indexOf($value){
        
        $lines = $this->lines;
        
        $index = array_search($value, $lines);
        
        return $index === false ? -1 : $index;
    }
}

///////////////////////////////////////////////////////////////////////////////
///                             TStream  (abstract)                         ///
///////////////////////////////////////////////////////////////////////////////
class TStream extends TObject{

        function __construct($self=nil){
                if ($self != nil)
                        $this->self = $self;
                else
                        $this->self = tstream_create();
        }
        
        function read(&$buffer, $count){
                $res = tstream_read($this->self,$count);
                $buffer = $res['b'];
                return $res['r'];
        }
        
        function write($buffer, $count){
                return tstream_write($this->self,$buffer,$count);
        }
        
        function writestr($str){
            return tstream_writestr($this->self, $str);
        }
        
        function seek($offset, $origin){
                return tstream_seek($this->self,$offset,$origin);
        }
        
        function readBuffer(&$buffer, $count){
                $buffer = tstream_read_buffer($this->self,$count);
        }
        
        function writeBuffer($buffer, $count){
                tstream_write_buffer($this->self,$buffer,$count);  
        }
        
        function copyFrom(TStream $source, $count){
                return tstream_copy_from($this->self,$source->self,$count);
        }
        
        function readComponent(TComponent $instance){
                return _c(tstream_read_component($this->self,$instance->self));
        }
        
        function readComponentRes(TComponent $instance){
                return _c(tstream_read_component_res($this->self, $instance->self));
        }
        
        function writeComponent(TComponent $instance){
                tstream_write_component($this->self,$instance->self);
        }
        
        function writeComponentRes($resName, TComponent $instance){
                tstream_write_component_res($this->self, $resName, $instance->self);
        }
        
        /*function writeDescendent(object $instance, object $ancestor){
                tstream_write_component($this->self,$instance->self,$ancestor->self); 
        }*/
        
        
        // properties...
        function get_position(){
                return tstream_get_position($this->self);
        }
        
        function set_position($pos){
                tstream_set_position($this->self,$pos);
        }
        
        
        function get_size(){
                return tstream_get_size($this->self);
        }
        
        function set_size($size){
                tstream_set_size($this->self,$size);
        }
        
        function get_text(){
            
            return tstream_readstr($this->self);  
        }
        
        function set_text($v){
            
            $this->writestr($v);
        }
        
        function setText($str){
            
            string2stream($this->self, $str);
        }
        
        function saveToFile($file){
            
            $file = replaceSl($file);
            file_put_contents($file, $this->text);
        }
        
        function loadFromFile($file, $in_charset = false, $out_charset = 'windows-1251'){
            
            $file = replaceSl($file);
            
            if ($in_charset)
                $this->text = iconv($in_charset, $out_charset, file_get_contents($file));
            else
                $this->text = file_get_contents($file);
        }
        
}

///////////////////////////////////////////////////////////////////////////////
///                             TMemoryStream                               ///
///////////////////////////////////////////////////////////////////////////////
class TMemoryStream extends TStream{
        
        function __construct($self = nil){
                if ($self != nil)
                        $this->self = $self;
                else
                        $this->self = tmstream_create();
        }
        
        function loadFromFile($filename){
            
            $filename = replaceSr($filename);
            tmstream_loadfile($this->self, $filename);
        }
        
        function saveToFile($filename){
            
            $filename = replaceSr($filename);
            tmstream_savefile($this->self, $filename);
        }
        
        function loadFromStream($m){
            
            tmstream_loadstream($this->self, $m->self);
        }
        
        function saveToStream($m){
            
            tmstream_savestream($this->self, $m->self);
        }
}

class TFileStream extends TStream{
        
        function __construct($filename, $mode){
                $this->self = tfilestream_create($filename, $mode);
        }
}