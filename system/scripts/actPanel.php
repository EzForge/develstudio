<?

c('fmMain->btn_openProject')->onClick = 'myProject::openFromFileDialog';
c('fmMain->btn_newProject')->onClick = 'myProject::newProjectDialog';
c('fmMain->btn_saveProject')->onClick = 'myProject::saveAsDVSDialog';
c('fmMain->btn_stop')->onClick = 'myUtils::stop';
c('fmMain->btn_run')->onClick  = 'myUtils::run';
c('fmMain->btn_newForm')->onClick = 'myUtils::newForm';
c('fmMain->btn_formList')->onClick = 'myUtils::formList';
c('fmMain->btn_delForm')->onClick = 'myUtils::deleteForm';

c('fmMain->fp_delete')->onClick = 'myUtils::deleteForm';
c('fmMain->hd_deleteform')->onClick = 'myUtils::deleteForm';
c('fmMain->hd_deleteform2')->onClick = 'myUtils::deleteForm';

c('fmMain->fp_new')->onClick    = 'myUtils::newForm';
c('fmMain->hd_newform')->onClick = 'myUtils::newForm';

c('fmMain->fp_rename')->onClick = 'myUtils::renameForm';
c('fmMain->hd_formrename')->onClick = 'myUtils::renameForm';

c('fmMain->fp_clone')->onClick  = 'myUtils::cloneForm';

c('fmMain->fp_left')->onClick   = 'myUtils::leftForm';
c('fmMain->hd_leftform')->onClick = 'myUtils::leftForm';

c('fmMain->fp_right')->onClick  = 'myUtils::rightForm';
c('fmMain->hd_rightform')->onClick = 'myUtils::rightForm';

c('fmMain->it_new')->onClick = 'myProject::newProjectDialog';
c('fmMain->it_open')->onClick= 'myProject::openFromFileDialog';
c('fmMain->it_save')->onClick= 'message_beep(66); myUtils::saveForm';
c('fmMain->it_saveas')->onClick = 'myProject::saveAsDVSDialog';

c('fmMain->it_undo')->onClick = 'myHistory::undo';
c('fmMain->it_redo')->onClick = 'myHistory::redo';
c('fmMain->it_preference')->onClick = 'myOptions::Options';

c('fmMain->it_buildproject')->onClick = 'myOptions::BuildProgram';
c('fmMain->btn_make')->onClick = 'myOptions::BuildProgram';
c('fmMain->it_projectoptions')->onClick = 'myOptions::ProjectOptions';
c('fmMain->it_projectmodules')->onClick = 'myOptions::PHPModules';
c('fmMain->it_stopprogram')->onClick = 'myUtils::stop';
c('fmMain->it_run')->onClick = 'myUtils::run';
c('fmMain->btn_rundebug')->onClick = 'myUtils::runDebug';