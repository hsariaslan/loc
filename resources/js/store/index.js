import { createStore, applyMiddleware } from 'redux';
import thunk from 'redux-thunk'
import {composeWithDevTools} from 'redux-devtools-extension'
import exampleReducer from '../reducers/exampleReducer';

const store = createStore(exampleReducer);

store.subscribe(() => {
    // console.log('current state', store.getState());
});

export default store;

// const initalState = {
//
// }
//
// const middleware = [thunk]
//
// const store = createStore(rootReducer, initalState, composeWithDevTools(applyMiddleware(...middleware)))
//
// export default store;
