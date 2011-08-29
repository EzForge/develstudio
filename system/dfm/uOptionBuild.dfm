object fmProjectOptions: TfmProjectOptions
  Left = 364
  Top = 173
  BorderStyle = bsDialog
  Caption = '{Project Options}'
  ClientHeight = 383
  ClientWidth = 458
  Color = clBtnFace
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  DesignSize = (
    458
    383)
  PixelsPerInch = 96
  TextHeight = 13
  object StatusBar1: TStatusBar
    Left = 0
    Top = 364
    Width = 458
    Height = 19
    AutoHint = True
    Panels = <>
    SimplePanel = True
  end
  object PageControl1: TPageControl
    Left = 8
    Top = 8
    Width = 441
    Height = 313
    ActivePage = TabSheet1
    TabOrder = 1
    object TabSheet1: TTabSheet
      Caption = '{General}'
      object Label1: TLabel
        Left = 16
        Top = 13
        Width = 83
        Height = 13
        Caption = '{Application title}'
      end
      object Label2: TLabel
        Left = 16
        Top = 59
        Width = 80
        Height = 13
        Caption = '{Program Name}'
      end
      object Label3: TLabel
        Left = 16
        Top = 104
        Width = 75
        Height = 13
        Caption = '{Program type}'
      end
      object e_apptitle: TEdit
        Left = 16
        Top = 32
        Width = 401
        Height = 21
        TabOrder = 0
      end
      object e_programname: TEdit
        Left = 16
        Top = 78
        Width = 401
        Height = 21
        TabOrder = 1
      end
      object c_programtype: TComboBox
        Left = 16
        Top = 121
        Width = 401
        Height = 21
        Style = csDropDownList
        ItemHeight = 13
        ItemIndex = 0
        TabOrder = 2
        Text = '{Standart}'
        Items.Strings = (
          '{Standart}'
          '{Desktop widget}'
          '{Silent}')
      end
      object GroupBox2: TGroupBox
        Left = 16
        Top = 153
        Width = 401
        Height = 113
        Caption = '{Debug}'
        TabOrder = 3
        object c_debugmode: TCheckBox
          Left = 24
          Top = 24
          Width = 337
          Height = 17
          Hint = '{Debug_mode_handle}'
          Caption = '{Enabled Debug Mode}'
          Checked = True
          ParentShowHint = False
          ShowHint = True
          State = cbChecked
          TabOrder = 0
        end
        object c_ignorewarnings: TCheckBox
          Left = 24
          Top = 56
          Width = 337
          Height = 17
          Caption = '{Ignore all warnings}'
          TabOrder = 1
        end
        object c_ignoreerrors: TCheckBox
          Left = 24
          Top = 80
          Width = 337
          Height = 17
          Caption = '{Ignore all errors}'
          TabOrder = 2
        end
      end
    end
    object TabSheet2: TTabSheet
      Caption = '{PHP Modules}'
      ImageIndex = 1
      ExplicitLeft = 0
      ExplicitTop = 31
      DesignSize = (
        433
        285)
      object Label4: TLabel
        Left = 16
        Top = 13
        Width = 65
        Height = 13
        Caption = '{Modules list}'
      end
      object Label5: TLabel
        Left = 183
        Top = 14
        Width = 63
        Height = 13
        Caption = '{Description}'
      end
      object list: TCheckListBox
        Left = 17
        Top = 32
        Width = 152
        Height = 233
        ItemHeight = 25
        Items.Strings = (
          'php_curl.dll'
          'php_mbstring.dll')
        Style = lbOwnerDrawFixed
        TabOrder = 0
      end
      object Panel1: TPanel
        Left = 175
        Top = 32
        Width = 242
        Height = 233
        Anchors = [akLeft, akTop, akRight, akBottom]
        TabOrder = 1
        object mod_desc: THTMLViewer
          Left = 1
          Top = 1
          Width = 240
          Height = 231
          Cursor = crDefault
          TabOrder = 0
          Align = alClient
          DefBackground = clWindow
          BorderStyle = htNone
          HistoryMaxCount = 0
          DefFontName = 'Tahoma'
          DefPreFontName = 'Courier New'
          DefFontSize = 8
          DefOverLinkColor = 16744448
          NoSelect = True
          ScrollBars = ssVertical
          CharSet = DEFAULT_CHARSET
          ServerRoot = './'
          PrintMarginLeft = 2.000000000000000000
          PrintMarginRight = 2.000000000000000000
          PrintMarginTop = 2.000000000000000000
          PrintMarginBottom = 2.000000000000000000
          PrintScale = 1.000000000000000000
        end
      end
    end
  end
  object BitBtn1: TBitBtn
    Left = 358
    Top = 330
    Width = 91
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 2
  end
  object BitBtn2: TBitBtn
    Left = 261
    Top = 330
    Width = 91
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 3
  end
end
