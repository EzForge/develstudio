object fmComponents: TfmComponents
  Left = 687
  Top = 131
  Width = 190
  Height = 546
  AutoScroll = True
  BorderIcons = [biSystemMenu]
  BorderStyle = bsSizeToolWin
  Caption = '{components}'
  Color = clBtnFace
  DragKind = dkDock
  DragMode = dmAutomatic
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  OldCreateOrder = False
  Position = poDefault
  ScreenSnap = True
  PixelsPerInch = 96
  TextHeight = 13
  object list: TCategoryButtons
    Left = 0
    Top = 21
    Width = 182
    Height = 499
    Align = alClient
    ButtonFlow = cbfVertical
    ButtonHeight = 26
    ButtonWidth = 32
    ButtonOptions = [boFullSize, boGradientFill, boShowCaptions, boBoldCaptions, boUsePlusMinus, boCaptionOnlyBorder]
    Images = fmMain.MainImages24
    BackgroundGradientDirection = gdVertical
    Categories = <>
    RegularButtonColor = 16119285
    SelectedButtonColor = 14079702
    ShowHint = True
    TabOrder = 0
  end
  object c_type: TComboBox
    Left = 0
    Top = 0
    Width = 182
    Height = 21
    Align = alTop
    Style = csDropDownList
    ItemHeight = 13
    ItemIndex = 0
    TabOrder = 1
    Text = '{Icons + text}'
    Items.Strings = (
      '{Icons + text}'
      '{Small Icons}')
  end
end
