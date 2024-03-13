// ignore_for_file: unnecessary_getters_setters

import '/backend/schema/util/schema_util.dart';

import 'index.dart';
import '/flutter_flow/flutter_flow_util.dart';

class UserStruct extends BaseStruct {
  UserStruct({
    String? id,
    String? nom,
    String? prenom,
    String? email,
    String? dateCreation,
  })  : _id = id,
        _nom = nom,
        _prenom = prenom,
        _email = email,
        _dateCreation = dateCreation;

  // "id" field.
  String? _id;
  String get id => _id ?? '';
  set id(String? val) => _id = val;
  bool hasId() => _id != null;

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

  // "email" field.
  String? _email;
  String get email => _email ?? '';
  set email(String? val) => _email = val;
  bool hasEmail() => _email != null;

  // "dateCreation" field.
  String? _dateCreation;
  String get dateCreation => _dateCreation ?? '';
  set dateCreation(String? val) => _dateCreation = val;
  bool hasDateCreation() => _dateCreation != null;

  static UserStruct fromMap(Map<String, dynamic> data) => UserStruct(
        id: data['id'] as String?,
        nom: data['nom'] as String?,
        prenom: data['prenom'] as String?,
        email: data['email'] as String?,
        dateCreation: data['dateCreation'] as String?,
      );

  static UserStruct? maybeFromMap(dynamic data) =>
      data is Map ? UserStruct.fromMap(data.cast<String, dynamic>()) : null;

  Map<String, dynamic> toMap() => {
        'id': _id,
        'nom': _nom,
        'prenom': _prenom,
        'email': _email,
        'dateCreation': _dateCreation,
      }.withoutNulls;

  @override
  Map<String, dynamic> toSerializableMap() => {
        'id': serializeParam(
          _id,
          ParamType.String,
        ),
        'nom': serializeParam(
          _nom,
          ParamType.String,
        ),
        'prenom': serializeParam(
          _prenom,
          ParamType.String,
        ),
        'email': serializeParam(
          _email,
          ParamType.String,
        ),
        'dateCreation': serializeParam(
          _dateCreation,
          ParamType.String,
        ),
      }.withoutNulls;

  static UserStruct fromSerializableMap(Map<String, dynamic> data) =>
      UserStruct(
        id: deserializeParam(
          data['id'],
          ParamType.String,
          false,
        ),
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
        email: deserializeParam(
          data['email'],
          ParamType.String,
          false,
        ),
        dateCreation: deserializeParam(
          data['dateCreation'],
          ParamType.String,
          false,
        ),
      );

  @override
  String toString() => 'UserStruct(${toMap()})';

  @override
  bool operator ==(Object other) {
    return other is UserStruct &&
        id == other.id &&
        nom == other.nom &&
        prenom == other.prenom &&
        email == other.email &&
        dateCreation == other.dateCreation;
  }

  @override
  int get hashCode =>
      const ListEquality().hash([id, nom, prenom, email, dateCreation]);
}

UserStruct createUserStruct({
  String? id,
  String? nom,
  String? prenom,
  String? email,
  String? dateCreation,
}) =>
    UserStruct(
      id: id,
      nom: nom,
      prenom: prenom,
      email: email,
      dateCreation: dateCreation,
    );
