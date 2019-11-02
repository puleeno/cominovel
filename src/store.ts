import { applyMiddleware, createStore } from "redux";
import { createEpicMiddleware } from "redux-observable";
import rootEpics from "./epics";
import rootReducers from "./reducers";

const epicMiddleware = createEpicMiddleware();

const store = createStore(
    rootReducers,
    {},
    applyMiddleware(epicMiddleware),
);

epicMiddleware.run(rootEpics);

export default store;
