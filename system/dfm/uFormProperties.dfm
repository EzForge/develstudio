object fmFormProperties: TfmFormProperties
  Left = 350
  Top = 163
  BorderStyle = bsDialog
  Caption = '{Form Properties}'
  ClientHeight = 461
  ClientWidth = 401
  Color = clBtnFace
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  FormStyle = fsStayOnTop
  OldCreateOrder = False
  Position = poScreenCenter
  DesignSize = (
    401
    461)
  PixelsPerInch = 96
  TextHeight = 13
  object BitBtn1: TBitBtn
    Left = 297
    Top = 428
    Width = 99
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 0
  end
  object BitBtn2: TBitBtn
    Left = 192
    Top = 428
    Width = 99
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 1
  end
  object GroupBox1: TGroupBox
    Left = 8
    Top = 8
    Width = 385
    Height = 414
    Anchors = [akLeft, akTop, akRight, akBottom]
    Caption = '{Properties}'
    TabOrder = 2
    object Label1: TLabel
      Left = 24
      Top = 32
      Width = 47
      Height = 13
      Caption = '{Position}'
    end
    object Label6: TLabel
      Left = 24
      Top = 72
      Width = 77
      Height = 13
      Caption = '{Window State}'
    end
    object Label7: TLabel
      Left = 24
      Top = 112
      Width = 61
      Height = 13
      Caption = '{Form Style}'
    end
    object Label8: TLabel
      Left = 24
      Top = 152
      Width = 69
      Height = 13
      Caption = '{Border Style}'
    end
    object c_position: TComboBox
      Left = 24
      Top = 48
      Width = 337
      Height = 21
      Style = csDropDownList
      ItemHeight = 13
      ItemIndex = 0
      TabOrder = 0
      Text = 'poDesigned'
      Items.Strings = (
        'poDesigned'
        'poDefault'
        'poDefaultPosOnly'
        'poDefaultSizeOnly'
        'poScreenCenter'
        'poDesktopCenter'
        'poMainFormCenter'
        'poOwnerFormCenter')
    end
    object GroupBox2: TGroupBox
      Left = 24
      Top = 203
      Width = 337
      Height = 121
      Caption = '{Constraints}'
      TabOrder = 1
      object Label2: TLabel
        Left = 16
        Top = 24
        Width = 59
        Height = 13
        Caption = '{Min height}'
      end
      object Label3: TLabel
        Left = 16
        Top = 64
        Width = 55
        Height = 13
        Caption = '{Min width}'
      end
      object Label4: TLabel
        Left = 176
        Top = 24
        Width = 63
        Height = 13
        Caption = '{Max height}'
      end
      object Label5: TLabel
        Left = 176
        Top = 64
        Width = 59
        Height = 13
        Caption = '{Max width}'
      end
      object e_minheight: TEdit
        Left = 16
        Top = 40
        Width = 145
        Height = 21
        TabOrder = 0
        Text = '0'
      end
      object e_minwidth: TEdit
        Left = 16
        Top = 80
        Width = 145
        Height = 21
        TabOrder = 1
        Text = '0'
      end
      object e_maxheight: TEdit
        Left = 176
        Top = 40
        Width = 145
        Height = 21
        TabOrder = 2
        Text = '0'
      end
      object e_maxwidth: TEdit
        Left = 176
        Top = 80
        Width = 145
        Height = 21
        TabOrder = 3
        Text = '0'
      end
    end
    object c_windowstate: TComboBox
      Left = 24
      Top = 88
      Width = 337
      Height = 21
      Style = csDropDownList
      ItemHeight = 13
      ItemIndex = 0
      TabOrder = 2
      Text = 'wsNormal'
      Items.Strings = (
        'wsNormal'
        'wsMinimized'
        'wsMaximized')
    end
    object c_formstyle: TComboBox
      Left = 24
      Top = 128
      Width = 337
      Height = 21
      Style = csDropDownList
      ItemHeight = 13
      ItemIndex = 2
      TabOrder = 3
      Text = 'fsNormal'
      Items.Strings = (
        'fsMDIChild'
        'fsMDIForm'
        'fsNormal'
        'fsStayOnTop')
    end
    object c_visible: TCheckBox
      Left = 184
      Top = 24
      Width = 177
      Height = 17
      Alignment = taLeftJustify
      Caption = '{Show form on startup}'
      TabOrder = 4
    end
    object GroupBox3: TGroupBox
      Left = 24
      Top = 330
      Width = 337
      Height = 57
      Caption = '{Border Icons}'
      TabOrder = 5
      object c_close: TCheckBox
        Left = 24
        Top = 24
        Width = 89
        Height = 17
        Caption = '{Close}'
        TabOrder = 0
      end
      object c_min: TCheckBox
        Left = 128
        Top = 24
        Width = 97
        Height = 17
        Caption = '{Minimize}'
        TabOrder = 1
      end
      object c_max: TCheckBox
        Left = 240
        Top = 24
        Width = 89
        Height = 17
        Caption = '{Maximize}'
        TabOrder = 2
      end
    end
    object c_borderstyle: TComboBox
      Left = 24
      Top = 168
      Width = 337
      Height = 21
      Style = csDropDownList
      ItemHeight = 13
      ItemIndex = 2
      TabOrder = 6
      Text = 'bsSizeable'
      Items.Strings = (
        'bsNone'
        'bsSingle'
        'bsSizeable'
        'bsDialog'
        'bsToolWindow'
        'bsSizeToolWin')
    end
  end
end
