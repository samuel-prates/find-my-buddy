import { combineReducers, createStore } from '@reduxjs/toolkit'
import { persistStore, persistReducer } from 'redux-persist'
import storage from 'redux-persist/lib/storage'

import { tokenSlice } from './TokenSlice'

const persistConfig = {
    key: 'token',
    storage,
}

const persistedReducer = persistReducer(persistConfig, combineReducers({ reducer: tokenSlice.reducer }))
export default () => {
    let store = createStore(persistedReducer)
    let persistor = persistStore(store)
    return { store, persistor }
  }