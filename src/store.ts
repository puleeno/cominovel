import { applyMiddleware, createStore } from "redux";
import { createEpicMiddleware } from "redux-observable";
import rootEpics from "./epics";
import reducers from "./reducers";

const epicMiddleware = createEpicMiddleware(rootEpics);

const store = createStore(
    reducers,
    {},
    applyMiddleware(epicMiddleware),
);

epicMiddleware.run(rootEpics);

export default store;
