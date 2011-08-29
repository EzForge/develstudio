object fmOptions: TfmOptions
  Left = 213
  Top = 150
  BorderStyle = bsDialog
  Caption = '{Preference}'
  ClientHeight = 283
  ClientWidth = 490
  Color = clBtnFace
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  OldCreateOrder = False
  Position = poScreenCenter
  PixelsPerInch = 96
  TextHeight = 13
  object Bevel1: TBevel
    Left = 8
    Top = 233
    Width = 474
    Height = 9
    Shape = bsTopLine
  end
  object PageControl1: TPageControl
    Left = 8
    Top = 8
    Width = 474
    Height = 219
    ActivePage = TabSheet2
    TabOrder = 0
    object TabSheet2: TTabSheet
      Caption = '{Backup}'
      ImageIndex = 1
      object Label2: TLabel
        Left = 16
        Top = 48
        Width = 90
        Height = 13
        Caption = '{Backup Dir Name}'
      end
      object Label3: TLabel
        Left = 16
        Top = 104
        Width = 85
        Height = 13
        Caption = '{Backup Interval}'
      end
      object Label4: TLabel
        Left = 199
        Top = 126
        Width = 26
        Height = 13
        Caption = '{min}'
      end
      object Label5: TLabel
        Left = 248
        Top = 104
        Width = 76
        Height = 13
        Caption = '{Backup Count}'
      end
      object backup_active: TCheckBox
        Left = 16
        Top = 16
        Width = 105
        Height = 17
        Caption = '{Backup Projects}'
        Checked = True
        State = cbChecked
        TabOrder = 0
      end
      object backup_dir: TEdit
        Left = 16
        Top = 67
        Width = 433
        Height = 21
        TabOrder = 1
        Text = 'backup'
      end
      object backup_interval: TEdit
        Left = 16
        Top = 123
        Width = 177
        Height = 21
        TabOrder = 2
        Text = '2'
      end
      object backup_count: TEdit
        Left = 248
        Top = 123
        Width = 201
        Height = 21
        TabOrder = 3
        Text = '3'
      end
    end
    object TabSheet1: TTabSheet
      Caption = '{Size and move}'
      ExplicitLeft = 0
      ExplicitHeight = 174
      object Label1: TLabel
        Left = 14
        Top = 40
        Width = 51
        Height = 13
        Caption = '{Grid Size}'
      end
      object e_gridsize: TEdit
        Left = 14
        Top = 56
        Width = 321
        Height = 21
        TabOrder = 0
        Text = '8'
      end
      object c_showgrid: TCheckBox
        Left = 14
        Top = 16
        Width = 321
        Height = 17
        Caption = '{Show grid}'
        Checked = True
        State = cbChecked
        TabOrder = 1
      end
    end
  end
  object BitBtn1: TBitBtn
    Left = 391
    Top = 244
    Width = 91
    Height = 27
    Caption = '{ok}'
    Font.Charset = RUSSIAN_CHARSET
    Font.Color = clWindowText
    Font.Height = -11
    Font.Name = 'Tahoma'
    Font.Style = [fsBold]
    ModalResult = 1
    ParentFont = False
    TabOrder = 1
  end
  object BitBtn2: TBitBtn
    Left = 294
    Top = 244
    Width = 91
    Height = 27
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 2
  end
end
