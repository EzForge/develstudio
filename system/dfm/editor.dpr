program editor;

uses
  Forms,
  uMain in 'uMain.pas' {fmMain},
  uEdit in 'uEdit.pas' {fmEdit},
  uComponents in 'uComponents.pas' {fmComponents},
  uPHPEditor in 'uPHPEditor.pas' {fmPHPEditor},
  uedt_Text in 'uedt_Text.pas' {edt_Text},
  uedt_EventTypes in 'uedt_EventTypes.pas' {edt_EventTypes},
  uFormList in 'uFormList.pas' {fmFormList},
  uInputText in 'uInputText.pas' {edt_inputText},
  uLogoIn in 'uLogoIn.pas' {fmLogoin},
  uObjectInspector in 'uObjectInspector.pas' {fmObjectInspector},
  uImageView in 'uImageView.pas' {edt_ImageView},
  uNewProject in 'uNewProject.pas' {fmNewProject},
  uFormProperties in 'uFormProperties.pas' {fmFormProperties},
  uPHPModules in 'uPHPModules.pas' {fmPHPModules},
  uOptionBuild in 'uOptionBuild.pas' {fmProjectOptions},
  uBuildProgram in 'uBuildProgram.pas' {fmBuildProgram},
  uOptions in 'uOptions.pas' {fmOptions},
  uSizesPosition in 'uSizesPosition.pas' {fmSizesPosition},
  uEasySelectDialog in 'uEasySelectDialog.pas' {fmEasySelectDialog},
  uFindError in 'uFindError.pas' {fmFindErrors},
  uAbout in 'uAbout.pas' {fmAbout},
  uPLoading in 'uPLoading.pas' {p_Loading},
  uBuildCompleted in 'uBuildCompleted.pas' {fmBuildCompleted},
  uMenuEditor in 'uMenuEditor.pas' {edt_menuEditor},
  uFindDialog in 'uFindDialog.pas' {edt_findDialog},
  uMSBCreator in 'uMSBCreator.pas' {fmMSBCreator},
  uPropsAndEvents in 'uPropsAndEvents.pas' {fmPropsAndEvents},
  uRunDebug in 'uRunDebug.pas' {fmRunDebug},
  uSynSettings in 'uSynSettings.pas' {fmEditorSettings};

{$R *.res}

begin
  Application.Initialize;
  Application.CreateForm(TfmMain, fmMain);
  Application.CreateForm(TfmEdit, fmEdit);
  Application.CreateForm(TfmComponents, fmComponents);
  Application.CreateForm(TfmPHPEditor, fmPHPEditor);
  Application.CreateForm(Tedt_Text, edt_Text);
  Application.CreateForm(Tedt_EventTypes, edt_EventTypes);
  Application.CreateForm(TfmFormList, fmFormList);
  Application.CreateForm(Tedt_inputText, edt_inputText);
  Application.CreateForm(TfmLogoin, fmLogoin);
  Application.CreateForm(TfmObjectInspector, fmObjectInspector);
  Application.CreateForm(Tedt_ImageView, edt_ImageView);
  Application.CreateForm(TfmNewProject, fmNewProject);
  Application.CreateForm(TfmFormProperties, fmFormProperties);
  Application.CreateForm(TfmPHPModules, fmPHPModules);
  Application.CreateForm(TfmProjectOptions, fmProjectOptions);
  Application.CreateForm(TfmBuildProgram, fmBuildProgram);
  Application.CreateForm(TfmOptions, fmOptions);
  Application.CreateForm(TfmSizesPosition, fmSizesPosition);
  Application.CreateForm(TfmEasySelectDialog, fmEasySelectDialog);
  Application.CreateForm(TfmFindErrors, fmFindErrors);
  Application.CreateForm(TfmAbout, fmAbout);
  Application.CreateForm(Tp_Loading, p_Loading);
  Application.CreateForm(TfmBuildCompleted, fmBuildCompleted);
  Application.CreateForm(Tedt_menuEditor, edt_menuEditor);
  Application.CreateForm(Tedt_findDialog, edt_findDialog);
  Application.CreateForm(TfmMSBCreator, fmMSBCreator);
  Application.CreateForm(TfmPropsAndEvents, fmPropsAndEvents);
  Application.CreateForm(TfmRunDebug, fmRunDebug);
  Application.CreateForm(TfmEditorSettings, fmEditorSettings);
  Application.Run;
end.
