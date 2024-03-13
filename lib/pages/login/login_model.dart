import '/auth/custom_auth/auth_util.dart';
import '/backend/api_requests/api_calls.dart';
import '/backend/schema/structs/index.dart';
import '/flutter_flow/flutter_flow_theme.dart';
import '/flutter_flow/flutter_flow_util.dart';
import '/flutter_flow/flutter_flow_widgets.dart';
import 'login_widget.dart' show LoginWidget;
import 'package:flutter/material.dart';
import 'package:google_fonts/google_fonts.dart';
import 'package:provider/provider.dart';

class LoginModel extends FlutterFlowModel<LoginWidget> {
  ///  State fields for stateful widgets in this page.

  final unfocusNode = FocusNode();
  // Stores action output result for [Backend Call - API (ConnectionUtilisateur)] action in Button widget.
  ApiCallResponse? resultConnection;
  // Stores action output result for [Backend Call - API (GetUnUtilisateur)] action in Button widget.
  ApiCallResponse? resultUtilisateur;
  // State field(s) for AdrMail widget.
  FocusNode? adrMailFocusNode;
  TextEditingController? adrMailController;
  String? Function(BuildContext, String?)? adrMailControllerValidator;
  // State field(s) for mdp widget.
  FocusNode? mdpFocusNode;
  TextEditingController? mdpController;
  late bool mdpVisibility;
  String? Function(BuildContext, String?)? mdpControllerValidator;

  /// Initialization and disposal methods.

  @override
  void initState(BuildContext context) {
    mdpVisibility = false;
  }

  @override
  void dispose() {
    unfocusNode.dispose();
    adrMailFocusNode?.dispose();
    adrMailController?.dispose();

    mdpFocusNode?.dispose();
    mdpController?.dispose();
  }

  /// Action blocks are added here.

  /// Additional helper methods are added here.
}
