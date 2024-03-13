import 'dart:convert';
import 'dart:typed_data';
import '../schema/structs/index.dart';

import '/flutter_flow/flutter_flow_util.dart';
import 'api_manager.dart';

export 'api_manager.dart' show ApiCallResponse;

const _kPrivateApiFunctionName = 'ffPrivateApiCall';

class EstCodeValideCall {
  static Future<ApiCallResponse> call({
    int? code,
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'estCodeValide',
      apiUrl: 'https://api.dlsappart.fr/api/estcodevalide',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'code': code,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }

  static String? errorLabel(dynamic response) =>
      castToType<String>(getJsonField(
        response,
        r'''$.data.reponse''',
      ));
}

class ConnectionUtilisateurCall {
  static Future<ApiCallResponse> call({
    String? adrMail = '',
    String? mdp = '',
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'ConnectionUtilisateur',
      apiUrl: 'https://api.dlsappart.fr/api/connecter',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'adrMail': adrMail,
        'mdp': mdp,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }

  static String? token(dynamic response) => castToType<String>(getJsonField(
        response,
        r'''$.data.reponse''',
      ));
}

class GetUnUtilisateurCall {
  static Future<ApiCallResponse> call({
    String? token = '',
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'GetUnUtilisateur',
      apiUrl: 'https://api.dlsappart.fr/api/getunutilisateur',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'token': token,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }

  static String? nom(dynamic response) => castToType<String>(getJsonField(
        response,
        r'''$.data.donnees.Utilisateur.nom''',
      ));
  static String? prenom(dynamic response) => castToType<String>(getJsonField(
        response,
        r'''$.data.donnees.Utilisateur.prenom''',
      ));
  static String? email(dynamic response) => castToType<String>(getJsonField(
        response,
        r'''$.data.donnees.Utilisateur.adrMail''',
      ));
  static String? dateCreation(dynamic response) =>
      castToType<String>(getJsonField(
        response,
        r'''$.data.donnees.Utilisateur.dateCreation''',
      ));
  static String? id(dynamic response) => castToType<String>(getJsonField(
        response,
        r'''$.data.donnees.Utilisateur.id''',
      ));
}

class GetTouteLesAnnoncesCall {
  static Future<ApiCallResponse> call({
    String? search = '',
    String? token = '',
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'GetTouteLesAnnonces',
      apiUrl: 'https://api.dlsappart.fr/api/gettouslesannonces',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'token': token,
        'search': search,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }

  static List<AnnonceStruct>? lesAnnonces(dynamic response) => (getJsonField(
        response,
        r'''$.data.donnees.lesAnnonces''',
        true,
      ) as List?)
          ?.withoutNulls
          .map((x) => AnnonceStruct.maybeFromMap(x))
          .withoutNulls
          .toList();
  static List<String>? lesTitreEtDescription(dynamic response) => (getJsonField(
        response,
        r'''$.data.donnees.lesAnnonces[:]['titre','description']''',
        true,
      ) as List?)
          ?.withoutNulls
          .map((x) => castToType<String>(x))
          .withoutNulls
          .toList();
}

class CreerUnUtilisateurCall {
  static Future<ApiCallResponse> call({
    String? nom = '',
    String? prenom = '',
    String? mdp = '',
    String? adrMail = '',
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'CreerUnUtilisateur',
      apiUrl: 'https://api.dlsappart.fr/api/creerunutilisateur',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'nom': nom,
        'prenom': prenom,
        'mdp': mdp,
        'adrMail': adrMail,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }

  static String? errorLabel(dynamic response) =>
      castToType<String>(getJsonField(
        response,
        r'''$.data.reponse''',
      ));
}

class GetMesannoncesCall {
  static Future<ApiCallResponse> call({
    String? token = '',
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'GetMesannonces',
      apiUrl: 'https://api.dlsappart.fr/api/getmesannonces',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'token': token,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }

  static List? lesAnnonces(dynamic response) => getJsonField(
        response,
        r'''$.data.donnees.lesAnnonces''',
        true,
      ) as List?;
}

class GetDetailAnnonceCall {
  static Future<ApiCallResponse> call({
    String? token = '',
    String? idAnnonce = '',
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'GetDetailAnnonce',
      apiUrl: 'https://api.dlsappart.fr/api/getuneannonce',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'token': token,
        'idAnnonce': idAnnonce,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }

  static AnnonceStruct? uneAnnonce(dynamic response) =>
      AnnonceStruct.maybeFromMap(getJsonField(
        response,
        r'''$.data.donnees.Annonce''',
      ));
}

class UploadImageCall {
  static Future<ApiCallResponse> call({
    FFUploadedFile? image,
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'UploadImage',
      apiUrl: 'https://api.dlsappart.fr/uploadPhoto.php',
      callType: ApiCallType.POST,
      headers: {},
      params: {
        'image': image,
      },
      bodyType: BodyType.MULTIPART,
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }

  static String? reponse(dynamic response) => castToType<String>(getJsonField(
        response,
        r'''$.data.reponse''',
      ));
}

class CreerUneAnnonceCall {
  static Future<ApiCallResponse> call({
    String? token = '',
    String? titre = '',
    String? description = '',
    String? taille = '',
    String? prix = '',
    String? imageURL = '',
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'CreerUneAnnonce',
      apiUrl: 'https://api.dlsappart.fr/api/creeruneannonce',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'token': token,
        'titre': titre,
        'description': description,
        'taille': taille,
        'prix': prix,
        'imageURL': imageURL,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }
}

class SupprimerUneAnnonceCall {
  static Future<ApiCallResponse> call({
    String? token = '',
    String? idAnnonce = '',
  }) async {
    return ApiManager.instance.makeApiCall(
      callName: 'SupprimerUneAnnonce',
      apiUrl: 'https://api.dlsappart.fr/api/supprimeruneannonce',
      callType: ApiCallType.GET,
      headers: {},
      params: {
        'token': token,
        'idAnnonce': idAnnonce,
      },
      returnBody: true,
      encodeBodyUtf8: false,
      decodeUtf8: false,
      cache: false,
      alwaysAllowBody: false,
    );
  }
}

class ApiPagingParams {
  int nextPageNumber = 0;
  int numItems = 0;
  dynamic lastResponse;

  ApiPagingParams({
    required this.nextPageNumber,
    required this.numItems,
    required this.lastResponse,
  });

  @override
  String toString() =>
      'PagingParams(nextPageNumber: $nextPageNumber, numItems: $numItems, lastResponse: $lastResponse,)';
}

String _serializeList(List? list) {
  list ??= <String>[];
  try {
    return json.encode(list);
  } catch (_) {
    return '[]';
  }
}

String _serializeJson(dynamic jsonVar, [bool isList = false]) {
  jsonVar ??= (isList ? [] : {});
  try {
    return json.encode(jsonVar);
  } catch (_) {
    return isList ? '[]' : '{}';
  }
}
