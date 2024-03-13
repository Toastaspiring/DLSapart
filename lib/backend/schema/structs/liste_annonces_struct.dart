// ignore_for_file: unnecessary_getters_setters

import '/backend/schema/util/schema_util.dart';

import 'index.dart';
import '/flutter_flow/flutter_flow_util.dart';

class ListeAnnoncesStruct extends BaseStruct {
  ListeAnnoncesStruct({
    List<AnnonceStruct>? annonces,
  }) : _annonces = annonces;

  // "Annonces" field.
  List<AnnonceStruct>? _annonces;
  List<AnnonceStruct> get annonces => _annonces ?? const [];
  set annonces(List<AnnonceStruct>? val) => _annonces = val;
  void updateAnnonces(Function(List<AnnonceStruct>) updateFn) =>
      updateFn(_annonces ??= []);
  bool hasAnnonces() => _annonces != null;

  static ListeAnnoncesStruct fromMap(Map<String, dynamic> data) =>
      ListeAnnoncesStruct(
        annonces: getStructList(
          data['Annonces'],
          AnnonceStruct.fromMap,
        ),
      );

  static ListeAnnoncesStruct? maybeFromMap(dynamic data) => data is Map
      ? ListeAnnoncesStruct.fromMap(data.cast<String, dynamic>())
      : null;

  Map<String, dynamic> toMap() => {
        'Annonces': _annonces?.map((e) => e.toMap()).toList(),
      }.withoutNulls;

  @override
  Map<String, dynamic> toSerializableMap() => {
        'Annonces': serializeParam(
          _annonces,
          ParamType.DataStruct,
          true,
        ),
      }.withoutNulls;

  static ListeAnnoncesStruct fromSerializableMap(Map<String, dynamic> data) =>
      ListeAnnoncesStruct(
        annonces: deserializeStructParam<AnnonceStruct>(
          data['Annonces'],
          ParamType.DataStruct,
          true,
          structBuilder: AnnonceStruct.fromSerializableMap,
        ),
      );

  @override
  String toString() => 'ListeAnnoncesStruct(${toMap()})';

  @override
  bool operator ==(Object other) {
    const listEquality = ListEquality();
    return other is ListeAnnoncesStruct &&
        listEquality.equals(annonces, other.annonces);
  }

  @override
  int get hashCode => const ListEquality().hash([annonces]);
}

ListeAnnoncesStruct createListeAnnoncesStruct() => ListeAnnoncesStruct();
