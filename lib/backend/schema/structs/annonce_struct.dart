// ignore_for_file: unnecessary_getters_setters

import '/backend/schema/util/schema_util.dart';

import 'index.dart';
import '/flutter_flow/flutter_flow_util.dart';

class AnnonceStruct extends BaseStruct {
  AnnonceStruct({
    String? id,
    String? titre,
    String? description,
    DateTime? date,
    String? taille,
    String? prix,
    String? imageURL,
    UtilisateurStruct? utilisateur,
  })  : _id = id,
        _titre = titre,
        _description = description,
        _date = date,
        _taille = taille,
        _prix = prix,
        _imageURL = imageURL,
        _utilisateur = utilisateur;

  // "id" field.
  String? _id;
  String get id => _id ?? '';
  set id(String? val) => _id = val;
  bool hasId() => _id != null;

  // "titre" field.
  String? _titre;
  String get titre => _titre ?? 'unTitre';
  set titre(String? val) => _titre = val;
  bool hasTitre() => _titre != null;

  // "description" field.
  String? _description;
  String get description => _description ?? '';
  set description(String? val) => _description = val;
  bool hasDescription() => _description != null;

  // "date" field.
  DateTime? _date;
  DateTime? get date => _date;
  set date(DateTime? val) => _date = val;
  bool hasDate() => _date != null;

  // "taille" field.
  String? _taille;
  String get taille => _taille ?? '';
  set taille(String? val) => _taille = val;
  bool hasTaille() => _taille != null;

  // "Prix" field.
  String? _prix;
  String get prix => _prix ?? '';
  set prix(String? val) => _prix = val;
  bool hasPrix() => _prix != null;

  // "ImageURL" field.
  String? _imageURL;
  String get imageURL => _imageURL ?? '';
  set imageURL(String? val) => _imageURL = val;
  bool hasImageURL() => _imageURL != null;

  // "Utilisateur" field.
  UtilisateurStruct? _utilisateur;
  UtilisateurStruct get utilisateur => _utilisateur ?? UtilisateurStruct();
  set utilisateur(UtilisateurStruct? val) => _utilisateur = val;
  void updateUtilisateur(Function(UtilisateurStruct) updateFn) =>
      updateFn(_utilisateur ??= UtilisateurStruct());
  bool hasUtilisateur() => _utilisateur != null;

  static AnnonceStruct fromMap(Map<String, dynamic> data) => AnnonceStruct(
        id: data['id'] as String?,
        titre: data['titre'] as String?,
        description: data['description'] as String?,
        date: data['date'] as DateTime?,
        taille: data['taille'] as String?,
        prix: data['Prix'] as String?,
        imageURL: data['ImageURL'] as String?,
        utilisateur: UtilisateurStruct.maybeFromMap(data['Utilisateur']),
      );

  static AnnonceStruct? maybeFromMap(dynamic data) =>
      data is Map ? AnnonceStruct.fromMap(data.cast<String, dynamic>()) : null;

  Map<String, dynamic> toMap() => {
        'id': _id,
        'titre': _titre,
        'description': _description,
        'date': _date,
        'taille': _taille,
        'Prix': _prix,
        'ImageURL': _imageURL,
        'Utilisateur': _utilisateur?.toMap(),
      }.withoutNulls;

  @override
  Map<String, dynamic> toSerializableMap() => {
        'id': serializeParam(
          _id,
          ParamType.String,
        ),
        'titre': serializeParam(
          _titre,
          ParamType.String,
        ),
        'description': serializeParam(
          _description,
          ParamType.String,
        ),
        'date': serializeParam(
          _date,
          ParamType.DateTime,
        ),
        'taille': serializeParam(
          _taille,
          ParamType.String,
        ),
        'Prix': serializeParam(
          _prix,
          ParamType.String,
        ),
        'ImageURL': serializeParam(
          _imageURL,
          ParamType.String,
        ),
        'Utilisateur': serializeParam(
          _utilisateur,
          ParamType.DataStruct,
        ),
      }.withoutNulls;

  static AnnonceStruct fromSerializableMap(Map<String, dynamic> data) =>
      AnnonceStruct(
        id: deserializeParam(
          data['id'],
          ParamType.String,
          false,
        ),
        titre: deserializeParam(
          data['titre'],
          ParamType.String,
          false,
        ),
        description: deserializeParam(
          data['description'],
          ParamType.String,
          false,
        ),
        date: deserializeParam(
          data['date'],
          ParamType.DateTime,
          false,
        ),
        taille: deserializeParam(
          data['taille'],
          ParamType.String,
          false,
        ),
        prix: deserializeParam(
          data['Prix'],
          ParamType.String,
          false,
        ),
        imageURL: deserializeParam(
          data['ImageURL'],
          ParamType.String,
          false,
        ),
        utilisateur: deserializeStructParam(
          data['Utilisateur'],
          ParamType.DataStruct,
          false,
          structBuilder: UtilisateurStruct.fromSerializableMap,
        ),
      );

  @override
  String toString() => 'AnnonceStruct(${toMap()})';

  @override
  bool operator ==(Object other) {
    return other is AnnonceStruct &&
        id == other.id &&
        titre == other.titre &&
        description == other.description &&
        date == other.date &&
        taille == other.taille &&
        prix == other.prix &&
        imageURL == other.imageURL &&
        utilisateur == other.utilisateur;
  }

  @override
  int get hashCode => const ListEquality().hash(
      [id, titre, description, date, taille, prix, imageURL, utilisateur]);
}

AnnonceStruct createAnnonceStruct({
  String? id,
  String? titre,
  String? description,
  DateTime? date,
  String? taille,
  String? prix,
  String? imageURL,
  UtilisateurStruct? utilisateur,
}) =>
    AnnonceStruct(
      id: id,
      titre: titre,
      description: description,
      date: date,
      taille: taille,
      prix: prix,
      imageURL: imageURL,
      utilisateur: utilisateur ?? UtilisateurStruct(),
    );
