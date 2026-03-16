
### Option 2: **Mermaid Live Editor** (https://mermaid.live)
- Go to mermaid.live
- Paste code in left panel
- See chart render on right

### Option 3: **Obsidian** (with Mermaid plugin)
- Create new note
- Wrap code in ```mermaid blocks

### Option 4: **Notion** (with Mermaid plugin)
- Use /mermaid command
- Paste code

### Option 5: **VS Code** (with Mermaid extension)
- Create .md file
- Paste code in mermaid code block

### Option 6: **Confluence** (with Mermaid macro)
- Insert Mermaid Diagram macro
- Paste code

---

## The Complete Flow Chart Code

```mermaid
flowchart TD
    %% Style definitions
    classDef startend fill:#f9f,stroke:#333,stroke-width:3px,font-weight:bold
    classDef process fill:#e1f5fe,stroke:#333,stroke-width:1px
    classDef decision fill:#fff3e0,stroke:#333,stroke-width:2px,font-weight:bold
    classDef external fill:#e8f5e8,stroke:#333,stroke-width:1px
    classDef subprocess fill:#f3e5f5,stroke:#333,stroke-width:2px,font-style:italic
    classDef doc fill:#fff0b5,stroke:#333,stroke-width:1px
    classDef portal fill:#ffe0b0,stroke:#333,stroke-width:2px
    classDef critical fill:#ffcccc,stroke:#f00,stroke-width:3px,font-weight:bold
    classDef wfmanage fill:#ffd580,stroke:#333,stroke-width:2px

    %% ========== PROJECT START ==========
    Start([PROJECT KICK-OFF]):::startend --> Setup[Document Controller<br/>Performs Initial Setup]:::process
    
    %% ========== INITIAL SETUP PHASE ==========
    Setup --> Admin[ADMINISTRATION SETUP<br/>Section 4]:::subprocess
    
    Admin --> CompList[1. Create Originating Companies<br/>Section 4.4.1]
    Admin --> DiscList[2. Setup Disciplines<br/>Section 4.4.2]
    Admin --> DocType[3. Setup Document Types<br/>Section 4.4.3]
    Admin --> DDM[4. Create Distribution Matrix (DDM)<br/>Section 4.4.4]
    Admin --> RunningNo[5. Configure Running Numbers<br/>Section 4.3]
    Admin --> Templates[6. Upload Document Templates<br/>Section 4.2.1]
    Admin --> ProjInfo[7. Configure Project Information<br/>Section 4.1.2]
    Admin --> Views[8. Setup MDR Views<br/>Section 5]
    
    DDM --> Portal[CREATE EXTERNAL PORTALS<br/>For Clients/Suppliers<br/>Section 4.4.1.1]:::critical
    
    Portal --> IntPath[INTERNAL DOCUMENTS PATH]:::subprocess
    Portal --> ExtPath[EXTERNAL DOCUMENTS PATH]:::subprocess
    
    %% ======================================================================
    %% INTERNAL DOCUMENTS PATH (AMC Creates Documents)
    %% ======================================================================
    
    %% ----- DOCUMENT CREATION PHASE -----
    IntPath --> IntCreate[DC Creates Profile Card<br/>Section 6.1.1]:::doc
    
    IntCreate --> IntPlanned{Planned or<br/>Unplanned?}
    IntPlanned -->|Planned| IntProgress[Progress Tracking Enabled<br/>Forecast Dates Set]
    IntPlanned -->|Unplanned| IntNoProgress[No Progress Tracking]
    
    IntProgress --> IntNotify[DC Sends Notification<br/>to Document Owner<br/>Section 7.3]
    IntNoProgress --> IntNotify
    
    IntNotify --> IntPrepare{Document Owner<br/>Prepares Document}
    
    IntPrepare --> IntTemplate[OPTION A:<br/>Generate from Template<br/>Section 7.1.1]
    IntPrepare --> IntUpload[OPTION B:<br/>Upload to Working Folder<br/>Section 7.1.2]
    IntPrepare --> IntExisting[OPTION C:<br/>Use Existing File]
    
    IntTemplate --> IntWorking[File in WORKING FOLDER]
    IntUpload --> IntWorking
    IntExisting --> IntWorking
    
    IntWorking --> IntTransferOwner[Document Owner/DC<br/>Transfer to NATIVE FOLDER<br/>Section 7.2]
    IntTransferOwner --> IntReady[✓ Document Ready for Review]
    
    %% ----- REVIEW WORKFLOW LAUNCH -----
    IntReady --> IntReview[DC LAUNCHES REVIEW WORKFLOW<br/>Section 8.1]:::critical
    
    IntReview --> IntRevSelect[Select File from Native/Converted Folder]
    IntReview --> IntRevAssignAuto[System Auto-populates Reviewers<br/>from DDM Group]
    
    IntRevAssignAuto --> IntRevCheck{Correct<br/>Reviewers?}
    IntRevCheck -->|Yes| IntRevLaunch[Launch Workflow]
    IntRevCheck -->|No| IntRevEdit[DC Edits/Adds/Removes Reviewers<br/>Before Launch]
    IntRevEdit --> IntRevLaunch
    
    IntRevLaunch --> IntRevEmail[Reviewers Receive Email Notifications]
    
    %% ----- REVIEWER TASKS -----
    IntRevEmail --> IntRevTask[Reviewers Access Task<br/>from My Pending Tasks / Email]
    
    IntRevTask --> RevMethod{Commenting<br/>Method}
    
    RevMethod --> RevPDF[PDF COMMENTING<br/>Section 8.2]
    RevMethod --> RevWord[WORD COMMENTING<br/>Section 8.3]
    RevMethod --> RevECom[E-COMMENT FORM<br/>Section 8.3.4]
    
    %% PDF Commenting Options
    RevPDF --> RevPDFMethod{Choose Method}
    RevPDFMethod --> RevPDFDownload[Method 1: Download & Upload<br/>Comment in Adobe, then upload]
    RevPDFMethod --> RevPDFApp[Method 2: Open in App<br/>PDF XChange/Foxit, save, refresh]
    
    RevPDFDownload --> RevPDFComplete
    RevPDFApp --> RevPDFComplete
    
    RevPDFComplete --> RevPDFRefresh[Click Refresh to Extract Comments]
    RevPDFRefresh --> RevComplete[Reviewer Completes Task]
    
    %% Word Commenting
    RevWord --> RevWordOpen[Open in Word Online or Desktop]
    RevWord --> RevWordTrack[Enable Track Changes]
    RevWord --> RevWordComment[Add Comments]
    RevWordComment --> RevWordSave[Save and Close]
    RevWordSave --> RevWordRefresh[Changes Auto-sync]
    RevWordRefresh --> RevComplete
    
    %% E-Commenting
    RevECom --> RevEClick[Click "New Comment" Link]
    RevECom --> RevEFill[Enter Page, Section, Comments]
    RevECom --> RevEAttach[Attach Files if Needed]
    RevECom --> RevESave[Save Comment]
    RevESave --> RevComplete
    
    RevComplete --> RevDone{All Reviewers<br/>Done?}
    
    %% ===== WORKFLOW MANAGEMENT DURING REVIEW =====
    RevDone -->|No - Still Waiting| RevWaiting[System Waits for Other Reviewers]
    
    %% CRITICAL: ADDING REVIEWERS MID-WORKFLOW
    RevWaiting --> WFLive{Workflow Active}:::wfmanage
    WFLive --> WFAdd[DC ADDS NEW REVIEWER<br/>MID-WORKFLOW<br/>Section 12.2]:::critical
    
    WFAdd --> WFAddStep[1. Go to Workflow > Workflow]
    WFAdd --> WFAddStep2[2. Enter New Reviewer in<br/>"Add New Actioner to Current Stage"]
    WFAddStep2 --> WFAddStep3[3. Click Submit]
    WFAddStep3 --> WFAddConfirm[New Reviewer Added<br/>Gets Task Immediately]
    
    WFAddConfirm --> IntRevTask
    
    %% REASSIGN TASKS
    WFLive --> WFReassign[DC REASSIGNS TASK<br/>To Different User<br/>Section 12.3]
    WFReassign --> WFReassignStep[Click "Reassign" Link<br/>Enter New User]
    WFReassignStep --> WFReassignConfirm[Original User Loses Access<br/>New User Gets Task]
    WFReassignConfirm --> IntRevTask
    
    %% REMOVE REVIEWER
    WFLive --> WFRremove[DC REMOVES REVIEWER<br/>Section 12.4]
    WFRremove --> WFRremoveStep[Click "Remove" Link<br/>Enter Reason]
    WFRremoveStep --> WFRremoveConfirm[Reviewer Removed<br/>Task Disappears from Their List]
    WFRremoveConfirm --> RevDone
    
    %% BULK WORKFLOW MANAGEMENT
    WFLive --> WFBulk[DC PERFORMS BULK ACTIONS<br/>Section 12.5]:::wfmanage
    WFBulk --> WFBulkReassign[Bulk Reassign Tasks<br/>Section 12.5.1]
    WFBulk --> WFBulkRemove[Bulk Remove Actioners<br/>Section 12.5.2]
    WFBulkReassign --> IntRevTask
    WFBulkRemove --> RevDone
    
    %% ----- COMMENT COMPILATION STAGE -----
    RevDone -->|Yes - All Complete| IntCompiler[COMMENT COMPILER TASK<br/>Assigned to Document Owner<br/>Section 8.2.2/8.3.2]
    
    IntCompiler --> CompMethod{Compiler Actions}
    
    CompMethod --> CompReview[Review All Comments]
    CompMethod --> CompAdd[Add/Edit/Delete Comments]
    CompMethod --> CompReply[Reply to Comments]
    
    CompReview --> CompCode{Select<br/>INTERNAL REVIEW CODE}
    
    CompCode -->|1 - Accepted| CompAccept[✓ Accepted - Proceed to Approval]
    CompCode -->|2 - Review with Comments| CompRevise[↻ Needs Revision - Document Owner Revises]
    CompCode -->|3 - Rejected| CompReject[✗ Rejected - Document Discarded/Replaced]
    
    CompAccept --> CompComplete[Comment Compiler Completes Task]
    
    CompComplete --> IntReviewComplete[REVIEW WORKFLOW COMPLETED<br/>Section 8.5]
    
    IntReviewComplete --> IntCommentSheet[✓ COMMENT SHEET GENERATED<br/>Auto-placed in Native Folder]
    IntReviewComplete --> IntCommentEmail[Email Notification Sent to<br/>Document Owner, DC, Information Group]
    IntReviewComplete --> IntProfileUpdate[Profile Card Progress Stage Updated]
    
    %% REVISION PATH
    CompRevise --> IntUpRev[DOCUMENT OWNER UP-REVISES<br/>Section 7.4]
    CompReject --> IntUpRev
    
    IntUpRev --> IntRevSingle[Single Up-Rev<br/>Section 7.4.1]
    IntUpRev --> IntRevBulk[Bulk Up-Rev<br/>Section 7.4.2]
    
    IntRevSingle --> IntPrepare
    IntRevBulk --> IntPrepare
    
    %% ----- APPROVAL WORKFLOW -----
    CompAccept --> IntConvert[DC CONVERTS WORD TO PDF<br/>Transfer File with Convert Option<br/>Section 9.1.1]
    
    IntConvert --> IntAppLaunch[DC LAUNCHES APPROVAL WORKFLOW<br/>Section 9.2]:::critical
    
    IntAppLaunch --> IntAppFile[Select File from Converted Folder]
    IntAppLaunch --> IntAppStages{Set Approval Stages}
    
    IntAppStages --> IntAppStage1[Stage 1 Approver(s)]
    IntAppStages --> IntAppStage2[Stage 2 Approver(s) - Optional]
    IntAppStages --> IntAppStage3[Stage 3 Approver(s) - Optional]
    IntAppStages --> IntAppStage4[Stage 4 Approver(s) - Optional]
    IntAppStage5[Stage 5 Approver(s) - Optional]
    
    IntAppLaunch --> IntAppDue[Set Due Dates<br/>Default from DDM or Custom]
    IntAppLaunch --> IntAppLaunchConfirm[APPROVAL WORKFLOW LAUNCHED]
    
    IntAppLaunchConfirm --> IntAppEmail[Approvers Receive Email]
    
    %% ----- APPROVER TASKS -----
    IntAppEmail --> IntAppTask[Approver Access Task]
    
    IntAppTask --> IntAppDownload[Download Document<br/>for Signing]
    IntAppDownload --> IntAppSign[Add Digital Signature<br/>using Adobe/DocuSign/etc.]
    IntAppSign --> IntAppUpload[Upload Signed Document]
    IntAppUpload --> IntAppDecision{Approve or<br/>Reject?}
    
    IntAppDecision -->|Approve| IntAppApprove[Add Optional Comment<br/>Click Approve]
    IntAppDecision -->|Reject| IntAppReject[Add MANDATORY Comment<br/>Click Reject]
    
    IntAppApprove --> IntAppNext{More Stages?}
    IntAppReject --> IntAppRejectEnd[WORKFLOW TERMINATED<br/>Status: REJECTED]
    
    IntAppRejectEnd --> IntPrepare
    
    IntAppNext -->|Yes - Next Stage| IntAppStageNext[Next Approver Gets Task]
    IntAppStageNext --> IntAppTask
    
    IntAppNext -->|No - Final Stage| IntApproved[DOCUMENT APPROVED<br/>Section 9.3.2]:::critical
    
    IntApproved --> IntAppComplete[Pending Approval Folder Deleted]
    IntApproved --> IntAppStatus[Document Status = "Approved"]
    IntApproved --> IntAppEmailComplete[Email Notification Sent]
    IntApproved --> IntLatest[Now accessible via<br/>"Open Latest Approved Document"<br/>Section 9.3.3]
    
    %% ======================================================================
    %% EXTERNAL DOCUMENTS PATH (Vendors/Clients Send to AMC)
    %% ======================================================================
    
    ExtPath --> ExtUser[EXTERNAL USER LOGS INTO<br/>COMPANY EXTERNAL PORTAL<br/>Section 11.3]
    
    %% ----- EXTERNAL SENDS DOCUMENTS TO AMC -----
    ExtUser --> ExtSend[External User Clicks<br/>"Incoming Transmittals"<br/>Section 11.3.2]
    
    ExtSend --> ExtFolder[Create/Upload Folder<br/>with Transmittal & Documents]
    ExtSend --> ExtSendTrans[Select Folder ><br/>Transmittal > Send Transmittal]
    
    ExtSendTrans --> ExtFill[Fill Transmittal Details]
    ExtFill --> ExtDocNum[Enter Document Numbers<br/>& Revisions]
    ExtFill --> ExtRFI[Select Reason For Issue]
    ExtFill --> ExtResponse[Set Response Required?]
    
    ExtFill --> ExtSubmitTrans[Click SUBMIT]
    
    ExtSubmitTrans --> ExtQueue[Status = "Queuing"]
    ExtQueue --> ExtProcessSys[SYSTEM PROCESSES EVERY 15 MINUTES<br/>Section 11.3.2]
    
    ExtProcessSys --> ExtCheckFile{File Checks}
    ExtCheckFile -->|Fail - Size >2GB| ExtError1[Error: File too large]
    ExtCheckFile -->|Fail - No Extension| ExtError2[Error: Missing file extension]
    ExtCheckFile -->|Fail - Native Missing| ExtError3[Error: Native file required]
    ExtCheckFile -->|Pass| ExtMove[Moves to Archived Incoming Transmittal]
    
    ExtError1 --> ExtUser
    ExtError2 --> ExtUser
    ExtError3 --> ExtUser
    
    ExtMove --> ExtDCNotify[DC RECEIVES EMAIL NOTIFICATION<br/>Section 10.1.1 - Method 1]:::critical
    
    %% ----- DC PROCESSES INCOMING TRANSMITTAL -----
    ExtDCNotify --> ExtDCAccess{DC Access Method}
    
    ExtDCAccess -->|Method 1| ExtEmail[Click Link in Email]
    ExtDCAccess -->|Method 2| ExtSearch[Transmittal Search<br/>Section 13.3]
    ExtDCAccess -->|Method 3| ExtList[Incoming Transmittals List]
    
    ExtEmail --> ExtTransferForm[TRANSFER FILE FORM OPENS]
    ExtSearch --> ExtTransferForm
    ExtList --> ExtTransferForm
    
    ExtTransferForm --> ExtReview{DC Reviews<br/>Transmittal}
    
    %% ----- REJECTION SCENARIOS -----
    ExtReview -->|Reject ENTIRE Transmittal| ExtRejectAll[DC CLICKS "REJECT TRANSMITTAL"<br/>Section 10.1.2]:::critical
    
    ExtRejectAll --> ExtRejectReason[Enter Rejection Reason]
    ExtRejectAll --> ExtRejectRemarks[Enter Remarks per Document]
    ExtRejectAll --> ExtRejectAttach[Attach Supporting Files if Needed]
    ExtRejectAll --> ExtRejectConfirm[Click Confirm]
    
    ExtRejectConfirm --> ExtRejectEmail[External User Gets Rejection Email]
    ExtRejectEmail --> ExtUser
    
    ExtReview -->|Reject SPECIFIC Documents| ExtRejectSome[DC SELECTS DOCUMENTS ><br/>"REJECT DOCUMENTS"<br/>Section 10.1.3]:::critical
    
    ExtRejectSome --> ExtRejectSomeReason[Enter Reason]
    ExtRejectSome --> ExtRejectSomeRemarks[Enter Remarks]
    ExtRejectSome --> ExtRejectSomeConfirm[Click Reject]
    
    ExtRejectSomeConfirm --> ExtRejectSomeEmail[External User Notified<br/>Only rejected docs highlighted]
    ExtRejectSomeEmail --> ExtTransferRemaining[Transfer Accepted Documents]
    
    %% ----- TRANSFER ACCEPTED DOCUMENTS -----
    ExtReview -->|Accept| ExtMassEdit[Use "Mass Edit" to Set<br/>Destination Folders<br/>Section 10.1.1 Step 8]
    
    ExtMassEdit --> ExtDest[Select Native/Converted Folder]
    ExtDest --> ExtApply[Click Apply]
    
    ExtApply --> ExtProfileCheck{For Each Document}
    
    ExtProfileCheck --> ExtProfileExists{Profile Card<br/>Exists?}
    
    ExtProfileExists -->|NO| ExtCreateProfile[DC CREATES PROFILE CARD FIRST<br/>Section 6.1]
    ExtCreateProfile --> ExtTransferForm
    
    ExtProfileExists -->|YES| ExtRevMatch{Revision<br/>Matches?}
    
    ExtRevMatch -->|YES| ExtTransfer[Transfer File]
    ExtRevMatch -->|NO - Different| ExtAutoUpRev[SYSTEM AUTO UP-REVISES<br/>Section 10.1.1 - Scenario C]
    
    ExtAutoUpRev --> ExtTransfer
    
    ExtTransfer --> ExtWarn1{File Name Matches<br/>Doc Number?}
    ExtWarn1 -->|NO| ExtWarnMsg[Warning: File name mismatch]
    ExtWarnMsg --> ExtContinue{Continue Anyway?}
    ExtContinue -->|Yes| ExtTransfer2
    ExtContinue -->|No| ExtFix[Fix File Name]
    ExtFix --> ExtTransferForm
    
    ExtWarn1 -->|YES| ExtTransfer2
    
    ExtTransfer2 --> ExtWarn2{File Already<br/>Received?}
    ExtWarn2 -->|YES| ExtWarnDate[Warning: File Received Date exists]
    ExtWarnDate --> ExtTransfer3
    
    ExtWarn2 -->|NO| ExtTransfer3
    
    ExtTransfer3 --> ExtSuccess[✓ FILES TRANSFERRED SUCCESSFULLY]
    
    ExtSuccess --> ExtFileRecDate[File Received Date Updated]
    ExtSuccess --> ExtLatestRec[Appears in "Latest Received Documents"<br/>Dashboard Section 3.6]
    ExtSuccess --> ExtDailySum[Daily Summary Email Sent]
    
    %% ----- EXTERNAL DOCUMENTS CAN NOW GO THROUGH REVIEW/APPROVAL -----
    ExtSuccess --> IntReview
    
    %% ======================================================================
    %% AMC SENDS DOCUMENTS TO EXTERNAL PARTIES (OUTGOING TRANSMITTALS)
    %% ======================================================================
    
    IntApproved --> ExtOutgoing[DC PREPARES TO SEND TO EXTERNAL PARTY<br/>Section 10.4]:::critical
    
    ExtOutgoing --> ExtOutSelect[Select Document(s) in MDR/Metadata Search]
    ExtOutgoing --> ExtOutTrans[Click Transmittal > Send Transmittal<br/>Section 10.4.1]
    
    ExtOutTrans --> ExtOutForm[Send Transmittal Form Opens]
    
    ExtOutForm --> ExtOutRecip{Select Recipient Type}
    ExtOutRecip -->|Client| ExtOutClient[Select Client Company]
    ExtOutRecip -->|Third Party| ExtOutThird[Select Supplier/Vendor]
    ExtOutRecip -->|Internal| ExtOutInternal[Select Internal Department]
    ExtOutRecip -->|Auth Class| ExtOutAuth[Select Certification Body]
    
    ExtOutClient --> ExtOutPortal{CRITICAL DECISION:<br/>Send to Company Subsite?}:::critical
    
    ExtOutPortal -->|YES - RECOMMENDED| ExtOutPortalYes[✓ Documents go to<br/>External Portal]
    ExtOutPortal -->|NO| ExtOutPortalNo[✗ Documents STAY in AMC only<br/>External users CAN'T see]
    
    ExtOutPortalYes --> ExtOutAttach{Include as<br/>Email Attachments?}
    ExtOutPortalNo --> ExtOutAttach
    
    ExtOutAttach -->|YES - Email with files| ExtOutSize[Warning: Max 20MB total]
    ExtOutAttach -->|NO - Portal only| ExtOutNoAttach[Clean email with links only]
    
    ExtOutForm --> ExtOutRFI[Select Reason For Issue]
    ExtOutForm --> ExtOutResponse{Response Required?}
    
    ExtOutResponse -->|YES| ExtOutDueDate[Set Required Response Date]
    ExtOutResponse -->|NO| ExtOutNoResponse
    
    ExtOutForm --> ExtOutInternalRec[Add Internal Recipients<br/>(AMC employees)]
    ExtOutForm --> ExtOutExternalRec[Add External Recipients<br/>(Email addresses)]
    ExtOutForm --> ExtOutCC[Add CC recipients]
    
    ExtOutForm --> ExtOutGenerate[Click GENERATE]
    
    ExtOutGenerate --> ExtOutNum[System Generates Transmittal Number<br/>Using Running Number Format]
    ExtOutGenerate --> ExtOutCover[Transmittal Cover Page Generated]
    
    ExtOutCover --> ExtOutReview[Review Cover Page]
    ExtOutCover --> ExtOutOverride[Optional: Upload Custom Cover]
    
    ExtOutReview --> ExtOutSend[Click SEND]
    
    ExtOutSend --> ExtOutConfirm[Confirmation Popup > OK]
    
    %% ----- POST-SENDING -----
    ExtOutSend --> ExtOutResult{What Happens Next}
    
    ExtOutResult -->|If Portal=YES| ExtOutPortalResult[Files Copied to External Portal]
    ExtOutResult -->|If Portal=NO| ExtOutNoPortalResult[No Portal Access]
    
    ExtOutPortalResult --> ExtOutEmail[Email Sent to All Recipients]
    ExtOutNoPortalResult --> ExtOutEmail
    
    ExtOutEmail --> ExtOutAckLink[Email Contains ACKNOWLEDGEMENT LINK<br/>Section 10.4.2]
    ExtOutEmail --> ExtOutViewLink[Email Contains VIEW LINK]
    
    %% ----- ACKNOWLEDGEMENT -----
    ExtOutAckLink --> ExtAckClick[Recipient Clicks Link]
    ExtAckClick --> ExtAckPage[Opens Acknowledgement Page]
    ExtAckPage --> ExtAckButton[Click "Acknowledge" Button]
    ExtAckButton --> ExtAckConfirm[Confirmation Message]
    
    ExtAckConfirm --> ExtAckUpdate[SYSTEM UPDATES STATUS<br/>Acknowledgement Status = "Acknowledged"]
    
    %% ----- TRACKING ACKNOWLEDGEMENT (TASK 19) -----
    ExtOutSend --> ExtTrack[DC CAN TRACK ACKNOWLEDGEMENT<br/>Section 10.4.5]
    
    ExtTrack --> ExtTrackMethod{How to Track}
    
    ExtTrackMethod -->|Method 1| ExtTrackList[Outgoing Transmittals List<br/>Check "Acknowledgement Status" Column]
    ExtTrackMethod -->|Method 2| ExtTrackSearch[Transmittal Search<br/>Section 13.3]
    
    ExtTrackList --> ExtTrackStatus[View: Acknowledged / Pending]
    ExtTrackSearch --> ExtTrackDetails[Click Transmittal Number<br/>View Acknowledged By/Date]
    
    %% ----- VOID/UNVOID TRANSMITTAL -----
    ExtOutSend --> ExtVoid[DC CAN VOID TRANSMITTAL<br/>Section 10.4.3]
    
    ExtVoid --> ExtVoidMethod{Before or After<br/>Sending?}
    
    ExtVoidMethod -->|Before Portal Send| ExtVoidBefore[Void - Transmittal Cancelled<br/>Never reaches portal]
    ExtVoidMethod -->|After Portal Send| ExtVoidAfter[Void - Must manually inform<br/>Delete from portal]
    
    ExtVoidBefore --> ExtVoidSelect[Select Transmittal ><br/>Outgoing Transmittal > Void/Unvoid]
    ExtVoidAfter --> ExtVoidSelect
    
    ExtVoidSelect --> ExtVoidConfirm[Click Confirm]
    ExtVoidConfirm --> ExtVoidStatus[Status = "Void"]
    
    %% ----- UPDATE REPLY TO -----
    ExtOutSend --> ExtReplyTo[DC CAN UPDATE "REPLY TO"<br/>Section 10.4.4]
    
    ExtReplyTo --> ExtReplySelect[Select Outgoing Transmittal]
    ExtReplyTo --> ExtReplyClick[Outgoing Transmittal > Update Reply To]
    ExtReplyTo --> ExtReplyChoose[Select Incoming Transmittal to Link]
    ExtReplyTo --> ExtReplyUpdate[Click Update]
    
    ExtReplyUpdate --> ExtReplyResult[Response Date & Transmittal Updated]
    
    %% ======================================================================
    %% SEARCH & RETRIEVAL (Continuous)
    %% ======================================================================
    
    IntApproved --> Search[USERS SEARCH FOR DOCUMENTS<br/>Section 13]:::subprocess
    ExtSuccess --> Search
    
    Search --> SearchMeta[METADATA SEARCH<br/>Section 13.1]
    Search --> SearchList[MDR LIST SEARCH<br/>Section 13.2]
    Search --> SearchTrans[TRANSMITTAL SEARCH<br/>Section 13.3]
    Search --> SearchBulk[BULK SEARCH by Excel<br/>Section 13.1.1]
    
    SearchMeta --> SearchFilters[Apply Filters:<br/>Discipline, Type, Date, Status]
    SearchMeta --> SearchSave[Save Search Criteria<br/>Section 13.1.2]
    SearchSave --> SearchPublic[Public View - All Users]
    SearchSave --> SearchPersonal[Personal View - Only Me]
    
    SearchBulk --> SearchExcel[Upload Excel with<br/>"Document No" column]
    SearchExcel --> SearchUpload[System Lists Uploaded Numbers]
    SearchExcel --> SearchFind[Click Search]
    SearchExcel --> SearchMissing[Missing profiles shown separately]
    
    SearchMeta --> SearchResults[Search Results Display]
    SearchResults --> SearchActions[Actions Available]
    
    SearchActions --> SearchView[View Profile Card - Section 6.2]
    SearchActions --> SearchOpen[Open Latest Approved - Section 9.3.3]
    SearchActions --> SearchComments[View Comments - Section 8.5.1]
    SearchActions --> SearchExport[Export Documents - Section 14.2]
    
    %% ======================================================================
    %% BULK OPERATIONS
    %% ======================================================================
    
    IntCreate --> Bulk[BULK OPERATIONS<br/>Section 14]:::subprocess
    
    Bulk --> BulkCreate[Bulk Create Profile Cards<br/>Section 6.1.2]
    Bulk --> BulkUpRev[Bulk Up-Revision<br/>Section 7.4.2]
    Bulk --> BulkImport[Bulk Import Files<br/>Section 14.1]
    Bulk --> BulkExport[Bulk Export Documents<br/>Section 14.2]
    Bulk --> BulkDDM[Bulk Create DDM<br/>Section 4.4.4.2]
    
    BulkCreate --> BulkTemplate[Download Bulk Import Template]
    BulkCreate --> BulkFill[Fill Excel with Document Data]
    BulkCreate --> BulkUpload[Upload Excel via Control > Bulk Import]
    BulkCreate --> BulkEmail[Receive Email with Success/Failure Report]
    
    BulkExport --> BulkSelect[Select Profile Cards<br/>Max 100 default]
    BulkExport --> BulkFileType[Choose File Types to Export]
    BulkExport --> BulkSubmit[Submit Export Job]
    BulkExport --> BulkWait[Wait 15-60 minutes<br/>Receive Email with Link]
    
    %% ======================================================================
    %% REPORTS & MONITORING
    %% ======================================================================
    
    IntApproved --> Reports[REPORTS MODULE<br/>Section 15]:::subprocess
    ExtSuccess --> Reports
    
    Reports --> ReportOverdue[OVERDUE REPORTS<br/>Section 15.2]
    Reports --> ReportProgress[PROGRESS REPORTS<br/>Section 15.3]
    Reports --> ReportTasks[TASKS REPORTS<br/>Section 15.4]
    Reports --> ReportQuality[QUALITY REPORTS<br/>Section 15.5]
    
    ReportOverdue --> Overdue1[Overdue Deliverables]
    ReportOverdue --> Overdue2[Overdue Responses TO External]
    ReportOverdue --> Overdue3[Overdue Responses FROM External]
    
    ReportProgress --> Progress1[S-Curve Report]
    ReportProgress --> Progress2[Raw Data - MDR]
    ReportProgress --> Progress3[Raw Data - TPMDR]
    ReportProgress --> Progress4[Progress by Discipline/WBS]
    
    ReportTasks --> Tasks1[All Pending Tasks]
    ReportTasks --> Tasks2[Workflow Tasks History]
    
    ReportQuality --> Quality1[Raw Data for Analysis]
    ReportQuality --> Quality2[Quality by Document Owner]
    ReportQuality --> Quality3[Quality by Discipline]
    ReportQuality --> Quality4[Quality by Company]
    
    %% ======================================================================
    %% ADDITIONAL FUNCTIONS
    %% ======================================================================
    
    IntApproved --> Additional[ADDITIONAL FUNCTIONS<br/>Section 16]:::subprocess
    
    Additional --> AddVersion[Version History<br/>Section 16.1]
    Additional --> AddDelegate[Delegation<br/>Section 16.2]
    Additional --> AddRelation[Manage Relationship<br/>Section 16.3]
    Additional --> AddViewRel[View Relationship<br/>Section 16.4]
    Additional --> AddSheets[Add Drawing Sheets<br/>Section 16.5]
    Additional --> AddCompile[Compile Comment Sheets<br/>Section 16.6]
    Additional --> AddUploadReturn[Upload Return Files<br/>Section 16.7]
    Additional --> AddGenComment[Generate Comment Sheet<br/>Section 16.8]
    
    AddDelegate --> DelegateSetup[Set Delegation Dates<br/>Delegate Tasks to Colleague]
    AddDelegate --> DelegateRemove[Remove Delegation<br/>Tasks Return to Original]
    
    AddRelation --> RelationType{Relationship Type}
    RelationType --> RelReplaces[Replaces / Replaced By]
    RelationType --> RelIncludes[Includes / Included In]
    
    AddGenComment --> GenPreReq[Prerequisite:<br/>Upload Return File as PDF<br/>Set File Type = "Return"]
    AddGenComment --> GenSelect[Select Profile Card ><br/>Workflow > Generate Comment Sheet]
    AddGenComment --> GenExtract[Comments Extracted to<br/>External Party Comment Section]
    
    %% ======================================================================
    %% WORKFLOW TERMINATION
    %% ======================================================================
    
    IntReview --> WFTerminateAll[TERMINATE WORKFLOW<br/>Section 12.6]:::critical
    IntAppLaunch --> WFTerminateAll
    
    WFTerminateAll --> WFTermSingle[Single Terminate<br/>Workflow > Terminate Workflow]
    WFTerminateAll --> WFTermBulk[Bulk Terminate<br/>Select Multiple > Workflow > Terminate]
    
    WFTermSingle --> WFTermConfirm[Click Confirm]
    WFTermBulk --> WFTermConfirm
    
    WFTermConfirm --> WFTermStatus[Status = "Terminated"<br/>All Tasks Removed]
    WFTermStatus --> IntPrepare
    
    %% ======================================================================
    %% PROJECT COMPLETION
    %% ======================================================================
    
    IntApproved --> Archive[Documents Archived]
    ExtSuccess --> Archive
    Archive --> End([PROJECT CLOSED]):::startend
    
    %% ======================================================================
    %% LEGEND
    %% ======================================================================
    
    Legend([LEGEND<br/>🔴 Red Border = CRITICAL STEP<br/>🟠 Orange = Workflow Management<br/>🟡 Yellow = Documents<br/>🟢 Green = External/Portal<br/>🔵 Blue = Standard Process<br/>🟣 Purple = Subprocess<br/>⬜ White = Decision Points]):::startend
