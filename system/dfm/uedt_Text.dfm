object edt_Text: Tedt_Text
  Left = 470
  Top = 230
  BorderStyle = bsSizeToolWin
  Caption = '{text_editor}'
  ClientHeight = 197
  ClientWidth = 357
  Color = clBtnFace
  Constraints.MinHeight = 155
  Constraints.MinWidth = 350
  Font.Charset = RUSSIAN_CHARSET
  Font.Color = clWindowText
  Font.Height = -11
  Font.Name = 'Tahoma'
  Font.Style = []
  OldCreateOrder = False
  DesignSize = (
    357
    197)
  PixelsPerInch = 96
  TextHeight = 13
  object Bevel1: TBevel
    Left = 8
    Top = 8
    Width = 341
    Height = 153
    Anchors = [akLeft, akTop, akRight, akBottom]
    Style = bsRaised
  end
  object BitBtn1: TBitBtn
    Left = 267
    Top = 165
    Width = 83
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{ok}'
    ModalResult = 1
    TabOrder = 0
    NumGlyphs = 2
  end
  object BitBtn2: TBitBtn
    Left = 177
    Top = 165
    Width = 83
    Height = 25
    Anchors = [akRight, akBottom]
    Caption = '{cancel}'
    ModalResult = 2
    TabOrder = 1
  end
  object memo: TRichEdit
    Left = 16
    Top = 16
    Width = 325
    Height = 137
    Anchors = [akLeft, akTop, akRight, akBottom]
    ScrollBars = ssBoth
    TabOrder = 2
    WantTabs = True
    WordWrap = False
  end
end
