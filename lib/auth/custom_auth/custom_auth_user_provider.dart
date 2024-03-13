import 'package:rxdart/rxdart.dart';

import '/backend/schema/structs/index.dart';
import 'custom_auth_manager.dart';

class DLSapartAuthUser {
  DLSapartAuthUser({
    required this.loggedIn,
    this.uid,
    this.userData,
  });

  bool loggedIn;
  String? uid;
  UserStruct? userData;
}

/// Generates a stream of the authenticated user.
BehaviorSubject<DLSapartAuthUser> dLSapartAuthUserSubject =
    BehaviorSubject.seeded(DLSapartAuthUser(loggedIn: false));
Stream<DLSapartAuthUser> dLSapartAuthUserStream() => dLSapartAuthUserSubject
    .asBroadcastStream()
    .map((user) => currentUser = user);
