object fmObjectInspector: TfmObjectInspector
  Left = 901
  Top = 70
  BorderIcons = [biSystemMenu]
  BorderStyle = bsSizeToolWin
  Caption = '{Objects}'
  ClientHeight = 556
  ClientWidth = 144
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
  object List: TListView
    Left = 0
    Top = 0
    Width = 144
    Height = 537
    Cursor = crHandPoint
    Align = alClient
    Columns = <>
    MultiSelect = True
    TabOrder = 0
  end
  object status: TStatusBar
    Left = 0
    Top = 537
    Width = 144
    Height = 19
    Cursor = crHandPoint
    Hint = '{2x click - to change object name}'
    Panels = <>
    ParentShowHint = False
    ShowHint = True
    SimplePanel = True
  end
end
