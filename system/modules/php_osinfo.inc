<?

// возвращает версию Win
function osinfo_winver(){}

// возвращает версию DOS
function osinfo_dosver(){}

// возвращает true если программа запущена под NT
function osinfo_isnt(){}

// возвращает последнюю версию установленного .NET
function osinfo_dotnet(){}

// возвращает одну из настроек ОС
function osinfo_locale($flag){}

// возвращает размер (в байтах) оперативной памяти компьютера (виртуальной или физической)
function osinfo_memory($flag){}

// возвращает серийный номер диска $disc
function osinfo_diskserial($disc){}

// возвращает true если программа запущена под админом
function osinfo_isadmin(){}