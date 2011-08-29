object fmPHPModules: TfmPHPModules
  Left = 397
  Top = 215
  BorderStyle = bsDialog
  Caption = '{PHP Modules}'
  ClientHeight = 361
  ClientWidth = 251
  Color = clBtnFace
  Font.Charset = DEFAULT_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'MS Sans Serif'
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 13
  object GroupBox1: TGroupBox
    Left = 8
    Top = 8
    Width = 233
    Height = 345
    Caption = '{Modules list}'
    Font.Charset = RUSSIAN_CHARSET
    Font.Color = clWindowText
    Font.Height = -11
    Font.Name = 'Tahoma'
    Font.Style = []
    ParentFont = False
    TabOrder = 0
    object list: TCheckListBox
      Left = 16
      Top = 32
      Width = 201
      Height = 265
      ItemHeight = 25
      Items.Strings = (
        'php_curl.dll'
        'php_mbstring.dll')
      Style = lbOwnerDrawFixed
      TabOrder = 0
    end
    object BitBtn1: TBitBtn
      Left = 136
      Top = 304
      Width = 83
      Height = 25
      Caption = '{ok}'
      ModalResult = 1
      TabOrder = 1
    end
    object BitBtn2: TBitBtn
      Left = 48
      Top = 304
      Width = 83
      Height = 25
      Caption = '{cancel}'
      ModalResult = 2
      TabOrder = 2
    end
    object GroupBox2: TGroupBox
      Left = 232
      Top = 16
      Width = 281
      Height = 281
      Caption = '{About}'
      TabOrder = 3
    end
  end
end
