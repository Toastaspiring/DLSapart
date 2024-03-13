// ignore_for_file: unnecessary_getters_setters

import '/backend/schema/util/schema_util.dart';

import 'index.dart';
import '/flutter_flow/flutter_flow_util.dart';

class UtilisateurStruct extends BaseStruct {
  UtilisateurStruct({
    String? nom,
    String? prenom,
    String? adrMail,
  })  : _nom = nom,
        _prenom = prenom,
        _adrMail = adrMail;

  // "nom" field.
  String? _nom;
  String get nom => _nom ?? '';
  set nom(String? val) => _nom = val;
  bool hasNom() => _nom != null;

  // "prenom" field.
  String? _prenom;
  String get prenom => _prenom ?? '';
  set prenom(String? val) => _prenom = val;
  bool hasPrenom() => _prenom != null;

  // "adrMail" field.
  String? _adrMail;
  String get adrMail => _adrMail ?? '';
  set adrMail(String? val) => _adrMail = val;
  bool hasAdrMail() => _adrMail != null;

  static UtilisateurStruct fromMap(Map<String, dynamic> data) =>
      UtilisateurStruct(
        nom: data['nom'] as String?,
        prenom: data['prenom'] as String?,
        adrMail: data['adrMail'] as String?,
      );

  static UtilisateurStruct? maybeFromMap(dynamic data) => data is Map
      ? UtilisateurStruct.fromMap(data.cast<String, dynamic>())
      : null;

  Map<String, dynamic> toMap() => {
        'nom': _nom,
        'prenom': _prenom,
        'adrMail': _adrMail,
      }.withoutNulls;

  @override
  Map<String, dynamic> toSerializableMap() => {
        'nom': serializeParam(
          _nom,
          ParamType.String,
        ),
        'prenom': serializeParam(
          _prenom,
          ParamType.String,
        ),
        'adrMail': serializeParam(
          _adrMail,
          ParamType.String,
        ),
      }.withoutNulls;

  static UtilisateurStruct fromSerializableMap(Map<String, dynamic> data) =>
      UtilisateurStruct(
        nom: deserializeParam(
          data['nom'],
          ParamType.String,
          false,
        ),
        prenom: deserializeParam(
          data['prenom'],
          ParamType.String,
          false,
        ),
        adrMail: deserializeParam(
          data['adrMail'],
          ParamType.String,
          false,
        ),
      );

  @override
  String toString() => 'UtilisateurStruct(${toMap()})';

  @override
  bool operator ==(Object other) {
    return other is UtilisateurStruct &&
        nom == other.nom &&
        prenom == other.prenom &&
        adrMail == other.adrMail;
  }

  @override
  int get hashCode => const ListEquality().hash([nom, prenom, adrMail]);
}

UtilisateurStruct createUtilisateurStruct({
  String? nom,
  String? prenom,
  String? adrMail,
}) =>
    UtilisateurStruct(
      nom: nom,
      prenom: prenom,
      adrMail: adrMail,
    );
