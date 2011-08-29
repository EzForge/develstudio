<?

c('fmMain')->onClick = 'myDesign::refreshForm';
c('fmMain->itemDel')->onClick = 'myDesign::keyDelete(); myDesign::hidePopup';
c('fmMain->itemCopy')->onClick = 'myDesign::keyCopy(); myDesign::hidePopup';
c('fmMain->itemCut')->onClick  = 'myDesign::keyCut(); myDesign::hidePopup';
c('fmMain->itemPaste')->onClick = 'myDesign::keyPaste(); myDesign::hidePopup';
c('fmMain->itemSendtofront')->onClick = 'myDesign::toFront(); myDesign::hidePopup';
c('fmMain->itemSendtoback')->onClick  = 'myDesign::toBack(); myDesign::hidePopup';
c('fmMain->itemLock')->onClick = 'myDesign::lockComponent(); myDesign::hidePopup';
c('fmMain->itemGroup')->onClick = 'myDesign::groupComponent(); myDesign::hidePopup';
c('fmMain->itemAddevent')->onClick = 'myEvents::clickAddEvent(0, true); _empty';

c('fmMain->editorPopup')->onPopup = 'myDesign::editorPopup';

c('fmMain->tabForms')->onMouseDown    = 'myDesign::tabFormClick';
c('fmObjectInspector->list')->onEdited= 'myDesign::objsInspectEdited';

c('fmMain->itService')->onClick = 'myDesign::itViewsPopup';