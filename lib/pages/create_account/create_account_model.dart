import '/auth/custom_auth/auth_util.dart';
import '/backend/api_requests/api_calls.dart';
import '/backend/schema/structs/index.dart';
import '/flutter_flow/flutter_flow_theme.dart';
import '/flutter_flow/flutter_flow_util.dart';
import '/flutter_flow/flutter_flow_widgets.dart';
import 'create_account_widget.dart' show CreateAccountWidget;
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart';

class CreateAccountModel extends FlutterFlowModel<CreateAccountWidget> {
  ///  State fields for stateful widgets in this page.

  final unfocusNode = FocusNode();
  // Stores action output result for [Backend Call - API (CreerUnUtilisateur)] action in Button widget.
  ApiCallResponse? resultCreation;
  // Stores action output result for [Backend Call - API (ConnectionUtilisateur)] action in Button widget.
  ApiCallResponse? resultConnection;
  // Stores action output result for [Backend Call - API (GetUnUtilisateur)] action in Button widget.
  ApiCallResponse? resultFetch;
  // State field(s) for nom widget.
  FocusNode? nomFocusNode;
  TextEditingController? nomController;
  String? Function(BuildContext, String?)? nomControllerValidator;
  // State field(s) for prenom widget.
  FocusNode? prenomFocusNode;
  TextEditingController? prenomController;
  String? Function(BuildContext, String?)? prenomControllerValidator;
  // State field(s) for email widget.
  FocusNode? emailFocusNode;
  TextEditingController? emailController;
  String? Function(BuildContext, String?)? emailControllerValidator;
  // State field(s) for mdp widget.
  FocusNode? mdpFocusNode;
  TextEditingController? mdpController;
  late bool mdpVisibility;
  String? Function(BuildContext, String?)? mdpControllerValidator;
  // State field(s) for mdpconf widget.
  FocusNode? mdpconfFocusNode;
  TextEditingController? mdpconfController;
  late bool mdpconfVisibility;
  String? Function(BuildContext, String?)? mdpconfControllerValidator;

  /// Initialization and disposal methods.

  @override
  void initState(BuildContext context) {
    mdpVisibility = false;
    mdpconfVisibility = false;
  }

  @override
  void dispose() {
    unfocusNode.dispose();
    nomFocusNode?.dispose();
    nomController?.dispose();

    prenomFocusNode?.dispose();
    prenomController?.dispose();

    emailFocusNode?.dispose();
    emailController?.dispose();

    mdpFocusNode?.dispose();
    mdpController?.dispose();

    mdpconfFocusNode?.dispose();
    mdpconfController?.dispose();
  }

  /// Action blocks are added here.

  /// Additional helper methods are added here.
}
